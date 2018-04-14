<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Common\UserModel;
use App\Models\Common\PostModel;
use App\Http\Controllers\Common\FileController;
use Illuminate\Support\Facades\DB;
use App\Models\Common\AreaModel;
use App\Models\Common\CategoryModel;
use App\Models\Common\TagModel;
use App\Models\Common\AttentionModel;
use App\Models\Common\MessageModel;

class PersonController extends Controller
{
    //个人中心设置
    public function index()
    {
    	return view('wenda.person.index');
    }
    
    //个人中心信息修改
    public function info(Request $request)
    {
    	if($request->isMethod('get'))
    	{
    		$userInfo = UserModel::where('id','=',Auth::id())->get();
    		$province = AreaModel::where('parent_id','0')->get();
    		$city = AreaModel::where('parent_id','=',$userInfo[0]->province)->get();
    		return view('wenda.person.info',['userinfo'=>$userInfo[0],'province'=>$province,'city'=>$city]);
    	}else{
    		if($request->get('uid') != Auth::id() )
    		{
    			return redirect()->back();
    		}
	    	$this->validate($request, [
	    		'uid'=>'required|numeric|exists:users,id',
	    		'realname'=>$request->get('realname') != null ?'sometimes|required|min:1|max:6':'',
	    		'email'=>$request->get('email') != null ?'sometimes|email':'',
	    		'province'=>$request->get('province') != null ?'sometimes|numeric|exists:areas,id':'',
	    		'city'=>$request->get('city') != null ?'sometimes|numeric|exists:areas,id':'',
	    		'mobile'=>$request->get('mobile') != null ?'sometimes|regex:/^1[34578][0-9]{9}$/':'',
	    		'birth'=>$request->get('birth') != null ?'sometimes|date':'',
	    		'url'=>$request->get('url') != null ?'sometimes|url':'',
	    		'qq'=>$request->get('qq') != null ?'sometimes|numeric':'',
	    		'weixin'=>$request->get('weixin') != null ?'sometimes':'',
	    		],[
	    		'required'=>':attribute为必填项',
	    		'min'=>':attribute至少:min个字节长',
	    		'max'=>':attribute超出限制',
	    		'url'=>'网站地址错误',
	    		],[
	    		'realname'=>'真实姓名',
	    		'email'=>'邮箱',
	    		'mobile'=>'手机号',
	    		'url'=>'个人主页',
	    		'qq'=>'qq号']);
	    	//更新数据
	      	DB::table('users')->where('id', $request->get('uid'))
	      					  ->update([
					          	'realname'=>$request->get('realname'),
					          	'email'=>$request->get('email'),
					          	'mobile'=>$request->get('mobile'),
					          	'birthday'=>$request->get('birth'),
					          	'site'=>$request->get('url'),
					          	'qq'=>$request->get('qq'),
					          	'weixin'=>$request->get('weixin'),
	      					  	'province'=>$request->get('province'),
	      					  	'city'=>$request->get('city'),
					          	'address'=>$request->get('location'),
					          	'graduateschool'=>$request->get('school'),
					          	'company'=>$request->get('company'),
					          	'occupation'=>$request->get('profession'),
					          	'bio'=>$request->get('signature')
				          		]);
          return redirect('/person/info');
    	}
    	
    }
    
    //个人密码修改
    public function password()
    {
    	return view('wenda.person.password');
    }
    
    //保存个人密码
    public function storePass(Request $request)
    {

    	$this->validate($request, [
    		'old_password'=>'required',
    		'new_password'=>'required|min:6|confirmed',
    		'new_password_confirmation'=>'required|min:6'
    	],[
    		'required'=>':attribute不能为空',
    		'min'=>':attribute 至少 :min 位',
    		'confirmed'=>'两次 :attribute 不一致'
    	],[
    		'old_password'=>'原密码',
    		'new_password'=>'新密码',
    		'new_password_confirmation'=>'确认密码',
    	]);
    	if($request->get('old_password') == $request->get('new_password'))
    	{
    		return redirect()->back()->withErrors(['new_password'=>'新密码不能与原密码一样'])->withInput();
    	}
    	$hashedPassword = UserModel::where('id',Auth::id())->get();
    	if(Hash::check($request->get('old_password'), $hashedPassword[0]['password']))
    	{
    		UserModel::where('id',Auth::id())->update([
    			'password'=>Hash::make($request->get('new_password'))
    		]);
    		return redirect()->back()->withErrors(['success'=>'密码更新成功']);
    	}else{
    		return redirect()->back()->withErrors(['old_password'=>'原密码错误'])->withInput();
    	}
    }
    
    //个人头像修改
    public function thumb()
    {
    	return view('wenda.person.thumb');
    }
    //保持个人头像
    public function thumbStore(Request $request)
    {
        $this->validate($request, [
        	'thumb.0'=>'required|mimes:jpg,jpeg,png,gif|max:2048'
        ],[
    		'required'=>':attribute不能为空',
        	'mimes'=>':attribute格式不正确',
    		'max'=>':attribute 最大 :max KB'
    	],[
    		'thumb.0'=>'图片',
    	]);
        $imgPath = FileController::saveThumbImg($request->file('thumb.0'));
        DB::table('users')
        ->where('id',Auth::id())
        ->update(['avator' => $imgPath]);
        return redirect('/person/thumb');
    }
    
    //我发布的文章
    public function post(Request $request)
    {
    	$this->validate($request, [
    			'cid'=>$request->get('cid') != null ?'required|numeric|exists:category,id':'',
    	]);
    	if($request->get('status','-1') >= 0)
    	{
    		if(!empty($request->get('cid')))
    		{
    			//查询该分类下的发布文章
    			$datas = PostModel::lists(Auth::id(),$request->get('status'),$request->get('cid'));
    		}else{
    			$datas = PostModel::lists(Auth::id(),$request->get('status'));
    		}
    		//查询该用户发布文章的分类
    		$cateIds = DB::table('posts')->where('user_id','=',Auth::id())->pluck('cate_id');
    		$cates = DB::table('category')->whereIn('id', $cateIds)->get();
    		return view('ask.person.post',['datas'=>$datas,'cates'=>$cates,'cid'=>$request->get('cid')?$request->get('cid'):'','status'=>$request->get('status')]);
    	}else{
    		//只查询分类
    		if(!empty($request->get('cid')))
    		{
    			//查询该分类下的发布文章
    			$datas = DB::table('posts')
				->leftjoin('users', 'posts.user_id', '=', 'users.id')
				->select('posts.id as post_id',
						'posts.title as title',
						'users.name as author',
						'users.id as user_id',
						'posts.excerpt as excerpt',
						'posts.content as content',
						'posts.thumb as thumb',
						'posts.created_at as created_at',
						'posts.comments as countcomment',
						'posts.status as status'
						)
				->where('posts.user_id','=',Auth::id())
				->where('posts.cate_id','=',$request->get('cid'))
				->paginate('15');
    		}else{
    			$datas = PostModel::lists(Auth::id());
    		}
    	}
    	//查询该用户发布文章的分类
    	$cateIds = DB::table('posts')->where('user_id','=',Auth::id())->pluck('cate_id');
    	$cates = DB::table('category')->whereIn('id', $cateIds)->get();
    	return view('ask.person.post',['datas'=>$datas,'cates'=>$cates,'cid'=>$request->get('cid')?$request->get('cid'):'','status'=>$request->get('status')?$request->get('status'):'-1']);
    }

    //我发布的问答
    public function answer(Request $request)
    {
    	$this->validate($request, [
    			'cid'=>$request->get('cid') != null ?'required|numeric|exists:category,id':'',
    	]);
    	if(!empty($request->get('cid')))
    	{
    		$questions = DB::table('questions')
    		->leftjoin('users', 'users.id', '=', 'questions.user_id')
    		->where('questions.user_id','=',Auth::id())
    		->where('questions.cate_id','=',$request->get('cid'))
    		->select('users.id as user_id','users.name as user_name', 'questions.title as title','questions.id as question_id', 'questions.content as content','questions.comments as countcomment','questions.created_at as created_at')
    		->orderBy('questions.created_at','desc')
    		->paginate('15');
    	}else{
    		$questions = DB::table('questions')
    		->leftjoin('users', 'users.id', '=', 'questions.user_id')
    		->where('questions.user_id','=',Auth::id())
    		->select('users.id as user_id','users.name as user_name', 'questions.title as title','questions.id as question_id', 'questions.content as content','questions.comments as countcomment','questions.created_at as created_at')
    		->orderBy('questions.created_at','desc')
    		->paginate('15');
    	}
    	//查询该用户发布文章的分类
    	$cateIds = DB::table('questions')->where('user_id','=',Auth::id())->pluck('cate_id');
    	$cates = DB::table('category')->whereIn('id', $cateIds)->get();
    	return view('ask.person.question',['questions'=>$questions,'cates'=>$cates,'cid'=>$request->get('cid')]);
    }
    
    //我收藏的文章
    public function postCollect(Request $request)
    {
    	$datas = DB::table('collections')
    	->leftjoin('users', 'collections.user_id', '=', 'users.id')
    	->leftjoin('posts', 'collections.source_id', '=', 'posts.id')
    	->where('collections.user_id','=',Auth::id())
    	->where('collections.source_type','=','1')
    	->select('posts.id as post_id',
    			'posts.title as title',
    			'users.name as author',
    			'posts.user_id as user_id',
    			'posts.cate_id as cateid',
    			'posts.excerpt as excerpt',
    			'posts.content as content',
    			'posts.thumb as thumb',
    			'posts.created_at as created_at',
    			'posts.comments as countcomment'
    			)->orderBy('posts.created_at','desc')->paginate('15');
    	return view('ask.person.postCollect',['datas'=>$datas]);
    }
    
    //我收藏的问答
    public function answerCollect(Request $request)
    {
    	$datas = DB::table('collections')
    	->leftjoin('users', 'collections.user_id', '=', 'users.id')
    	->leftjoin('questions', 'collections.source_id', '=', 'questions.id')
    	->where('collections.user_id','=',Auth::id())
    	->where('collections.source_type','=','2')
    	->select(
    			'users.id as user_id',
    			'users.name as user_name',
    			'questions.title as title',
    			'questions.id as question_id',
    			'questions.content as content',
                'questions.comments as comments',
    			'questions.created_at as created_at'
    			)
    	->orderBy('questions.created_at','desc')
    	->paginate('15');
    	return view('ask.person.answerCollect',['questions'=>$datas]);
    }
    
    //我的关注
    public function myAttention(Request $request)
    {
    	//关注的话题
    	$tags = DB::table('attentions')
    	->leftjoin('tags', 'attentions.source_id', '=', 'tags.id')
    	->where('attentions.source_type','=','3')
    	->where('attentions.user_id','=',Auth::id())
    	->select(
    			'tags.id as id',
    			'tags.name as name',
    			'tags.desc as desc'
    	)->orderBy('tags.created_at','desc')->paginate('15');
    	return view('wenda.person.topicAttention',['tags'=>$tags]);
    }
    
    //我关注的人
    public function userAttention(Request $request)
    {
    	$datas = DB::table('attentions')
    	->leftjoin('users', 'attentions.source_id', '=', 'users.id')
    	->where('attentions.user_id','=',Auth::id())
    	->where('attentions.source_type','=','1')
    	->select('users.id as user_id',
    			'users.name as name',
    			'users.realname as realname',
    			'users.email as email',
    			'users.created_at as created_at',
    			'users.mobile as mobile',
    			'users.birthday as birthday',
    			'users.site as site',
    			'users.qq as qq',
    			'users.weixin as weixin',
    			'users.graduateschool as graduateschool',
    			'users.province as province',
    			'users.city as city',
    			'users.company as company',
    			'users.occupation as occupation',
    			'users.avator as avator',
    			'users.bio as bio'
    			)->orderBy('users.created_at','desc')->paginate('15');
    	return view('wenda.person.userAttention',['datas'=>$datas]);
    }
    
    //我关注的话题
    public function topicAttention(Request $request)
    {
    	//关注的话题
    	$topics = DB::table('attentions')
    	->leftjoin('tags', 'attentions.source_id', '=', 'tags.id')
    	->where('attentions.source_type','=','3')
    	->where('attentions.user_id','=',Auth::id())
    	->select(
    			'tags.id as tag_id',
                'tags.thumb as tag_thumb',
    			'tags.name as tag_name',
    			'tags.desc as tag_desc'
    	)->orderBy('tags.created_at','desc')->paginate('15');
    	return view('ask.person.topic',['topics'=>$topics]);
    }
    
    //新增我关注的话题
    public function topicCreate(Request $request)
    {
    	$this->validate($request, [
    			'tid'=>'required|numeric|exists:tags,id',
    	]);
    	//新增用户关联话题
    	AttentionModel::updateOrCreate([
    			'user_id'=>Auth::id(),
    			'source_id'=>$request->get('tid'),
    			'source_type'=>'3'
    	], [
    			'user_id'=>Auth::id(),
    			'source_id'=>$request->get('tid'),
    			'source_type'=>'3'
    	]);
    	//话题关注数量加一
    	DB::table('tags')->increment('watchs', 1);
    	return redirect()->back();
    }
    
    //取消我关注的话题
    public function topicCancel(Request $request)
    {
    	$this->validate($request, [
    			'tid'=>'required|numeric|exists:tags,id',
    	]);
    	//新增用户关联话题
    	AttentionModel::where([
    			'user_id'=>Auth::id(),
    			'source_id'=>$request->get('tid'),
    			'source_type'=>'3'
    	])->delete();
    	//话题关注数量减一
    	DB::table('tags')->decrement('watchs', 1);
    	return redirect()->back();
    }
    
    //我已关注的话题
    public function topiced(Request $request)
    {
    	$datas = DB::table('attentions')
    	->leftjoin('users', 'attentions.user_id', '=', 'users.id')
    	->leftjoin('tags', 'attentions.source_id', '=', 'tags.id')
    	->where('attentions.source_type','=','3')
    	->where('attentions.user_id','=',Auth::id())
    	->select(
    			'tags.id as id',
    			'tags.name as name',
    			'tags.desc as desc'
    	)->orderBy('tags.created_at','desc')->paginate('20');
    	return view('wenda.topic.topiced',['tags'=>$datas]);
    }
    //我的私信
    public function letter()
    {
    	$fromUserIds = DB::table('messages')
    	->leftjoin('users', 'messages.from_user_id', '=', 'users.id')
    	->where('messages.to_user_id','=',Auth::id())
    	->orderBy('messages.created_at','desc')
    	->pluck('messages.from_user_id')->toArray();
    	//数据去重
    	$fromUserIds = array_unique($fromUserIds);
    	//查找唯一私信
    	$datas = DB::table('messages')
    	->leftjoin('users', 'messages.from_user_id', '=', 'users.id')
    	->whereIn('messages.from_user_id', $fromUserIds)
    	->select(
    			'users.id as id',
    			'users.name as username',
    			'messages.content as content',
    			'messages.to_user_id as to_user_id',
    			'messages.from_user_id as from_user_id',
    			'messages.created_at as created_at'
    	)->orderBy('messages.created_at','desc')
    	->paginate('10');
    	
    	return view('wenda.person.receivedLetter',['datas'=>$datas]);
    }
    //私信详情
    public function letterDetail(Request $request)
    {
    	$this->validate($request, [
    			'from_user_id'=>'required|numeric|exists:users,id',
    			'to_user_id'=>'required|numeric|exists:users,id'
    	]);
    	if($request->get('from_user_id') == Auth::id() || $request->get('to_user_id') == Auth::id())
    	{
    		$datas = DB::table('messages')
	    	->leftjoin('users', 'messages.from_user_id', '=', 'users.id')
	    	->where(['messages.from_user_id'=>$request->get('from_user_id'),'messages.to_user_id'=>$request->get('to_user_id')])
	    	->orWhere(['messages.from_user_id'=>$request->get('to_user_id'),'messages.to_user_id'=>$request->get('from_user_id')])
	    	->select(
	    			'users.id as id',
	    			'users.name as username',
	    			'messages.content as content',
	    			'messages.to_user_id as to_user_id',
	    			'messages.from_user_id as from_user_id',
	    			'messages.created_at as created_at'
	    	)->orderBy('messages.created_at','desc')->paginate('10');
    		return view('wenda.person.letterDetail',
    				[
    					'datas'=>$datas,
    					'to_user'=>Auth::id() == $request->get('from_user_id')?$request->get('to_user_id'):$request->get('from_user_id'),
    					'from_user_id'=>$request->get('from_user_id'),
    					'to_user_id'=>$request->get('to_user_id')
    				]);
    	}
    	abort('403');
    }
    //写私信
    public function sendLetter()
    {
    	$users = UserModel::where('id','!=',Auth::id())->get();
    	return view('wenda.person.sendLetter',['users'=>$users]);
    }
    
    public function storeLetter(Request $request)
    {
    	if($request->get('from_user_id') != Auth::id())
    	{
    		return redirect()->back();
    	}
    	$this->validate($request, [
    		'from_user_id'=>'required|numeric|exists:users,id',
    		'to_user_id'=>'required|numeric|exists:users,id',
    		'content'=>'required|min:1',
    	]);
    	MessageModel::create([
    		'from_user_id'=>$request->get('from_user_id'),
    		'to_user_id'=>$request->get('to_user_id'),
    		'content'=>$request->get('content')
    	]);
    	if(str_contains($_SERVER['HTTP_REFERER'],'sendLetter'))
    	{
    		return redirect('/person/letter');
    	}else{
    		return redirect()->back();
    	}
    }
    
}
