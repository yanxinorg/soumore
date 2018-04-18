<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Common\QuestionModel;
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
        //用户所在省份
       if(!empty($userInfo[0]->province))
       {
           $province = AreaModel::where('id',$userInfo[0]->province)->pluck('name')->toArray();
           $province = $province[0];
       }else{
           $province = '';
       }
        //用户所在城市
        if(!empty($userInfo[0]->city))
        {
            $city = AreaModel::where('id',$userInfo[0]->city)->pluck('name')->toArray();
            $city = $city[0];
        }else{
            $city = '';
        }
    	//文章信息
    	$datas = PostModel::lists($request->get('uid'));
        //文章总数
        $countPost = PostModel::where('user_id',$request->get('uid'))->count();
        //问答
        $questions = QuestionModel::where('user_id',$request->get('uid'))->paginate('15');
        //问答总数
        $countQuestion = QuestionModel::where('user_id',$request->get('uid'))->count();
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
    	return view('ask.home.post',['userinfo'=>$userInfo[0],'datas'=>$datas,'province'=>$province,'city'=>$city,'countPost'=>$countPost,'questions'=>$questions,'countQuestion'=>$countQuestion,'topicUsers'=>$topicUsers,'countUsers'=>$countUsers,'fans'=>$fans,'countFans'=>$countFans,'topics'=>$topics,'countTopics'=>$countTopics,'uid'=>$request->get('uid'),'islooked'=>$islooked,'recents'=>$recents]);
    }
    
    public function post(Request $request)
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
        //用户所在省份
        if(!empty($userInfo[0]->province))
        {
            $province = AreaModel::where('id',$userInfo[0]->province)->pluck('name')->toArray();
            $province = $province[0];
        }else{
            $province = '';
        }
        //用户所在城市
        if(!empty($userInfo[0]->city))
        {
            $city = AreaModel::where('id',$userInfo[0]->city)->pluck('name')->toArray();
            $city = $city[0];
        }else{
            $city = '';
        }
        //文章信息
        $datas = PostModel::lists($request->get('uid'));
        $countPost = PostModel::where('user_id',$request->get('uid'))->count();
        //问答总数
        $countQuestion = QuestionModel::where('user_id',$request->get('uid'))->count();
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
        return view('ask.home.post',['userinfo'=>$userInfo[0],'province'=>$province,'city'=>$city,'datas'=>$datas,'countPost'=>$countPost,'countQuestion'=>$countQuestion,'topicUsers'=>$topicUsers,'countUsers'=>$countUsers,'fans'=>$fans,'countFans'=>$countFans,'topics'=>$topics,'countTopics'=>$countTopics,'uid'=>$request->get('uid'),'islooked'=>$islooked,'recents'=>$recents]);
    }
    
    //问答
    public function question(Request $request)
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
        //用户所在省份
        if(!empty($userInfo[0]->province))
        {
            $province = AreaModel::where('id',$userInfo[0]->province)->pluck('name')->toArray();
            $province = $province[0];
        }else{
            $province = '';
        }
        //用户所在城市
        if(!empty($userInfo[0]->city))
        {
            $city = AreaModel::where('id',$userInfo[0]->city)->pluck('name')->toArray();
            $city = $city[0];
        }else{
            $city = '';
        }
        //文章总数
        $countPost = PostModel::where('user_id',$request->get('uid'))->count();
        //问答
        $questions = QuestionModel::where('user_id',$request->get('uid'))->paginate('15');
        //问答总数
        $countQuestion = QuestionModel::where('user_id',$request->get('uid'))->count();
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
        return view('ask.home.question',['userinfo'=>$userInfo[0],'province'=>$province,'city'=>$city,'countPost'=>$countPost,'questions'=>$questions,'countQuestion'=>$countQuestion,'topicUsers'=>$topicUsers,'countUsers'=>$countUsers,'fans'=>$fans,'countFans'=>$countFans,'topics'=>$topics,'countTopics'=>$countTopics,'uid'=>$request->get('uid'),'islooked'=>$islooked,'recents'=>$recents]);
    }

    //关注
    public function topic(Request $request)
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
        //用户所在省份
        if(!empty($userInfo[0]->province))
        {
            $province = AreaModel::where('id',$userInfo[0]->province)->pluck('name')->toArray();
            $province = $province[0];
        }else{
            $province = '';
        }
        //用户所在城市
        if(!empty($userInfo[0]->city))
        {
            $city = AreaModel::where('id',$userInfo[0]->city)->pluck('name')->toArray();
            $city = $city[0];
        }else{
            $city = '';
        }
        //文章总数
        $countPost = PostModel::where('user_id',$request->get('uid'))->count();
        //问答总数
        $countQuestion = QuestionModel::where('user_id',$request->get('uid'))->count();
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
        return view('ask.home.topic',['userinfo'=>$userInfo[0],'province'=>$province,'city'=>$city,'countPost'=>$countPost,'countQuestion'=>$countQuestion,'topicUsers'=>$topicUsers,'countUsers'=>$countUsers,'fans'=>$fans,'countFans'=>$countFans,'topics'=>$topics,'countTopics'=>$countTopics,'uid'=>$request->get('uid'),'islooked'=>$islooked,'recents'=>$recents]);
    }

    //关注的人
    public function topicUser(Request $request)
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
        //用户所在省份
        if(!empty($userInfo[0]->province))
        {
            $province = AreaModel::where('id',$userInfo[0]->province)->pluck('name')->toArray();
            $province = $province[0];
        }else{
            $province = '';
        }
        //用户所在城市
        if(!empty($userInfo[0]->city))
        {
            $city = AreaModel::where('id',$userInfo[0]->city)->pluck('name')->toArray();
            $city = $city[0];
        }else{
            $city = '';
        }
        //文章总数
        $countPost = PostModel::where('user_id',$request->get('uid'))->count();
        //问答总数
        $countQuestion = QuestionModel::where('user_id',$request->get('uid'))->count();
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
            ->select('users.id as user_id','users.name as name')->orderBy('attentions.created_at','desc')->paginate('15');
        //关注总人数
        $countUsers = DB::table('attentions')
            ->leftjoin('users', 'attentions.source_id', '=', 'users.id')
            ->where('attentions.source_type','=','1')
            ->where('attentions.user_id','=',$request->get('uid'))->count();
        return view('ask.home.topicUser',['userinfo'=>$userInfo[0],'province'=>$province,'city'=>$city,'countPost'=>$countPost,'countQuestion'=>$countQuestion,'topicUsers'=>$topicUsers,'countUsers'=>$countUsers,'fans'=>$fans,'countFans'=>$countFans,'topics'=>$topics,'countTopics'=>$countTopics,'uid'=>$request->get('uid'),'islooked'=>$islooked,'recents'=>$recents]);
    }
    //他的粉丝
    public function topicedUser(Request $request)
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
        //用户所在省份
        if(!empty($userInfo[0]->province))
        {
            $province = AreaModel::where('id',$userInfo[0]->province)->pluck('name')->toArray();
            $province = $province[0];
        }else{
            $province = '';
        }
        //用户所在城市
        if(!empty($userInfo[0]->city))
        {
            $city = AreaModel::where('id',$userInfo[0]->city)->pluck('name')->toArray();
            $city = $city[0];
        }else{
            $city = '';
        }
        //文章总数
        $countPost = PostModel::where('user_id',$request->get('uid'))->count();
        //问答总数
        $countQuestion = QuestionModel::where('user_id',$request->get('uid'))->count();
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
            ->select('users.id as user_id','users.name as name')->orderBy('attentions.created_at','desc')->paginate('15');
        //关注总人数
        $countUsers = DB::table('attentions')
            ->leftjoin('users', 'attentions.source_id', '=', 'users.id')
            ->where('attentions.source_type','=','1')
            ->where('attentions.user_id','=',$request->get('uid'))->count();
        return view('ask.home.topicedUser',['userinfo'=>$userInfo[0],'province'=>$province,'city'=>$city,'countPost'=>$countPost,'countQuestion'=>$countQuestion,'topicUsers'=>$topicUsers,'countUsers'=>$countUsers,'fans'=>$fans,'countFans'=>$countFans,'topics'=>$topics,'countTopics'=>$countTopics,'uid'=>$request->get('uid'),'islooked'=>$islooked,'recents'=>$recents]);

    }

    //关注的话题
    public function topics(Request $request)
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
        //用户所在省份
        if(!empty($userInfo[0]->province))
        {
            $province = AreaModel::where('id',$userInfo[0]->province)->pluck('name')->toArray();
            $province = $province[0];
        }else{
            $province = '';
        }
        //用户所在城市
        if(!empty($userInfo[0]->city))
        {
            $city = AreaModel::where('id',$userInfo[0]->city)->pluck('name')->toArray();
            $city = $city[0];
        }else{
            $city = '';
        }
        //文章总数
        $countPost = PostModel::where('user_id',$request->get('uid'))->count();
        //问答总数
        $countQuestion = QuestionModel::where('user_id',$request->get('uid'))->count();
        //是否关注、
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
                'tags.name as tag_name',
                'tags.thumb as tag_thumb'
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
            ->select('users.id as user_id','users.name as name')->orderBy('attentions.created_at','desc')->paginate('15');
        //关注总人数
        $countUsers = DB::table('attentions')
            ->leftjoin('users', 'attentions.source_id', '=', 'users.id')
            ->where('attentions.source_type','=','1')
            ->where('attentions.user_id','=',$request->get('uid'))->count();
        return view('ask.home.topics',['userinfo'=>$userInfo[0],'province'=>$province,'city'=>$city,'countPost'=>$countPost,'countQuestion'=>$countQuestion,'topicUsers'=>$topicUsers,'countUsers'=>$countUsers,'fans'=>$fans,'countFans'=>$countFans,'topics'=>$topics,'countTopics'=>$countTopics,'uid'=>$request->get('uid'),'islooked'=>$islooked,'recents'=>$recents]);

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

}
