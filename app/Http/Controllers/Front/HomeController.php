<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\UserModel;
use App\Models\Common\AreaModel;
use App\Models\Common\PostModel;
use Illuminate\Support\Facades\DB;
use App\Models\Common\AttentionModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Common\VisitorModel;
use Carbon\Carbon;

class HomeController extends Controller
{
    //个人主页
    public function index(Request $request)
    {
    	$this->validate($request, [
    		'uid'=>'required|numeric|exists:users,id'
    	]);
    	//记录最近访问信息
    	if(!empty(Auth::id()) && Auth::id() != $request->get('uid'))
    	{
    		VisitorModel::updateOrCreate([
    			'user_id'=>$request->get('uid'),
    			'visitor_id'=>Auth::id()
    		], [
    			'user_id'=>$request->get('uid'),
    			'visitor_id'=>Auth::id(),
    			'visitor_time'=>Carbon::now()
    		]);
    	}
    	
    	//用户信息
    	$userInfo = UserModel::where('id','=',$request->get('uid'))->get();
    	//文章信息
    	$datas = PostModel::lists($request->get('uid'));
        $countPost = PostModel::where('user_id',$request->get('uid'))->count();
    	//是否关注、
    	if(!empty(Auth::id()))
    	{
    		//查看该用户是否已经关注该主页用户
    		if(AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$request->get('uid'),'source_type'=>'1'])->exists())
    		{
    			//关注了该用户
    			$islooked = true;
    		}else{
    			$islooked = false;
    		}
    	}else{
    		$islooked = false;
    	}
    	//最近访客 获取最近8位访客
    	$recents = DB::table('visitors')
    	->leftjoin('users', 'visitors.visitor_id', '=', 'users.id')
    	->where('visitors.user_id','=',$request->get('uid'))
    	->select(
    			'users.id as user_id',
    			'users.name as user_name',
    	        'users.avator as user_avator',
    			'visitors.visitor_time as visitor_time'
    			)
    			->orderBy('visitors.visitor_time','desc')
    			->paginate('8');
    	//关注的话题
    	$topics = DB::table('attentions')
    	->leftjoin('tags', 'attentions.source_id', '=', 'tags.id')
    	->where('attentions.user_id','=',$request->get('uid'))
    	->where('attentions.source_type','=','3')
    	->select(
    			'tags.id as tag_id',
    			'tags.name as tag_name'
    			)
    	->orderBy('attentions.created_at','desc')
    	->paginate('8');
        //关注话题总数
        $countTopics = DB::table('attentions')
            ->leftjoin('tags', 'attentions.source_id', '=', 'tags.id')
            ->where('attentions.user_id','=',$request->get('uid'))
            ->where('attentions.source_type','=','3')->count();
    	//粉丝用户
    	$fans = DB::table('attentions')
    	->leftjoin('users', 'attentions.user_id', '=', 'users.id')
    	->where('attentions.source_type','=','1')
    	->where('attentions.source_id','=',$request->get('uid'))
    	->select('users.id as user_id','users.name as name')->orderBy('attentions.created_at','desc')->paginate('20');
        //粉丝总数
        $countFans = DB::table('attentions')
            ->leftjoin('users', 'attentions.user_id', '=', 'users.id')
            ->where('attentions.source_type','=','1')
            ->where('attentions.source_id','=',$request->get('uid'))->count();
	    //关注的用户
	    $topicUsers = DB::table('attentions')
	    ->leftjoin('users', 'attentions.source_id', '=', 'users.id')
	    ->where('attentions.source_type','=','1')
	    ->where('attentions.user_id','=',$request->get('uid'))
	    ->select('users.id as user_id','users.name as name')->orderBy('attentions.created_at','desc')->paginate('20');
        //关注总人数
        $countUsers = DB::table('attentions')
            ->leftjoin('users', 'attentions.source_id', '=', 'users.id')
            ->where('attentions.source_type','=','1')
            ->where('attentions.user_id','=',$request->get('uid'))->count();
    	return view('ask.home.index',['userinfo'=>$userInfo[0],'datas'=>$datas,'topicUsers'=>$topicUsers,'countUsers'=>$countUsers,'fans'=>$fans,'countFans'=>$countFans,'topics'=>$topics,'countTopics'=>$countTopics,'countPost'=>$countPost,'uid'=>$request->get('uid'),'islooked'=>$islooked,'recents'=>$recents]);
    }
    
    public function post(Request $request)
    {
    	$this->validate($request, [
    			'uid'=>'required|numeric|exists:users,id'
    	]);
    	$userInfo = UserModel::where('id','=',$request->get('uid'))->get();
    	$datas = PostModel::lists($request->get('uid'));
    	//是否关注、
    	if(!empty(Auth::id()))
    	{
    		//查看该用户是否已经关注该主页用户
    		if(AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$request->get('uid'),'source_type'=>'1'])->exists())
    		{
    			//关注了该用户
    			$islooked = true;
    		}else{
    			$islooked = false;
    		}
    	}else{
    		$islooked = false;
    	}
    	return view('wenda.home.post',['userinfo'=>$userInfo[0],'datas'=>$datas,'province'=>$userInfo[0]['province'],'city'=>$userInfo[0]['city'],'uid'=>$request->get('uid'),'islooked'=>$islooked]);
    }
    
    //提问
    public function question(Request $request)
    {
    	$this->validate($request, [
    			'uid'=>'required|numeric|exists:users,id'
    	]);
    	$userInfo = UserModel::where('id','=',$request->get('uid'))->get();
    	$datas = DB::table('questions')
    	->leftjoin('users', 'questions.user_id', '=', 'users.id')
    	->where('questions.user_id','=',$request->get('uid'))
    	->select(
    			'users.id as user_id',
    			'users.name as user_name',
    			'questions.title as title',
    			'questions.id as question_id',
    			'questions.content as content',
    			'questions.created_at as created_at'
    			)
    			->orderBy('questions.created_at','desc')
    			->paginate('15');
    	//是否关注、
    	if(!empty(Auth::id()))
    	{
    		//查看该用户是否已经关注该主页用户
    		if(AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$request->get('uid'),'source_type'=>'1'])->exists())
    			{
    				//关注了该用户
    				$islooked = true;
    			}else{
    				$islooked = false;
    			}
    		}else{
    		$islooked = false;
    	}
        return view('wenda.home.question',['userinfo'=>$userInfo[0],'questions'=>$datas,'province'=>$userInfo[0]['province'],'city'=>$userInfo[0]['city'],'uid'=>$request->get('uid'),'islooked'=>$islooked]);
    }
    
    //他的回答
    public function answer(Request $request)
    {
    	$this->validate($request, [
    			'uid'=>'required|numeric|exists:users,id'
    	]);
    	$userInfo = UserModel::where('id','=',$request->get('uid'))->get();
    	$datas = DB::table('questions')
    	->leftjoin('answers', 'questions.id', '=', 'answers.question_id')
    	->leftjoin('users', 'questions.user_id', '=', 'users.id')
    	->where('answers.user_id','=',$request->get('uid'))
    	->select(
    			'users.id as user_id',
    			'users.name as user_name',
    			'questions.title as title',
    			'questions.id as question_id',
    			'questions.content as content',
    			'questions.created_at as created_at'
    			)
    	->orderBy('questions.created_at','desc')
    	->paginate('15');
    	//是否关注、
    	if(!empty(Auth::id()))
    	{
    		//查看该用户是否已经关注该主页用户
    		if(AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$request->get('uid'),'source_type'=>'1'])->exists())
    		{
    			//关注了该用户
    			$islooked = true;
    		}else{
    			$islooked = false;
    		}
    	}else{
    		$islooked = false;
    	}
    	return view('wenda.home.answer',['userinfo'=>$userInfo[0],'questions'=>$datas,'province'=>$userInfo[0]['province'],'city'=>$userInfo[0]['city'],'uid'=>$request->get('uid'),'islooked'=>$islooked]);
    }
    //他的粉丝
    public function fans(Request $request)
    {
    	$this->validate($request, [
    			'uid'=>'required|numeric|exists:users,id'
    	]);
    	$userInfo = UserModel::where('id','=',$request->get('uid'))->get();
    	//关注的粉丝
    	$datas = DB::table('attentions')
    	->leftjoin('users', 'attentions.user_id', '=', 'users.id')
    	->where('attentions.source_type','=','1')
    	->where('attentions.source_id','=',$request->get('uid'))
    	->select(
    			'users.id as user_id',
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
    			'users.bio as bio'
    	)->orderBy('users.created_at','desc')->paginate('20');
    	//是否关注、
    	if(!empty(Auth::id()))
    	{
    		//查看该用户是否已经关注该主页用户
    		if(AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$request->get('uid'),'source_type'=>'1'])->exists())
    		{
    			//关注了该用户
    			$islooked = true;
    		}else{
    			$islooked = false;
    		}
    	}else{
    		$islooked = false;
    	}
    	return view('wenda.home.fans',['userinfo'=>$userInfo[0],'datas'=>$datas,'uid'=>$request->get('uid'),'islooked'=>$islooked]);
    }
    
}
