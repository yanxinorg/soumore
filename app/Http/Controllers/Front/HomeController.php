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
    //用户信息
    private $userinfo ;
    //文章信息
    private $posts;
    //视频信息
    private $videos;
    //文章总数
    private $countPost;
    //问答
    private $questions;
    //问答总数
    private $countQuestion;
    //视频总数
    private $countVideo;
    //是否关注
    private $islooked =  false;
    //最近访客
    private $recents;
    //关注的话题
    private $topics;
    //关注的话题总数
    private $countTopics;
    //粉丝
    private $fans;
    //粉丝总数
    private $countFans;
    //关注的用户
    private $topicUsers;
    //关注总人数
    private $countUsers;
    //用户所在省
    private $province;
    //用户所在市
    private $city;
    //用户id
    private $uid;

    public function __construct(Request $request)
    {
        $this->validate($request, [
            'uid'=>'required|numeric|exists:users,id'
        ]);
        $this->uid = $request->get('uid');
        //用户信息
        $this->userinfo = UserModel::where('id','=',$request->get('uid'))->get();
        $this->userinfo = ($this->userinfo)[0];
        //用户所在省份
        if(!empty($this->userinfo->province))
        {
            $this->province = AreaModel::where('id',$this->userinfo->province)->pluck('name')->toArray();
            $this->province = $this->province[0];
        }else{
            $this->province = '';
        }
        //用户所在城市
        if(!empty($this->userinfo->city))
        {
            $this->city = AreaModel::where('id',$this->userinfo->city)->pluck('name')->toArray();
            $this->city = $this->city[0];
        }else{
            $this->city = '';
        }
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
        //文章信息
        $this->posts = PostModel::lists($request->get('uid'),'1');
        //文章总数
        $this->countPost = PostModel::where('user_id',$request->get('uid'))->where('status','1')->count();
        //问答
        $this->questions =  DB::table('questions')
            ->leftjoin('users', 'users.id', '=', 'questions.user_id')
            ->leftjoin('category', 'questions.cate_id', '=', 'category.id')
            ->where('questions.user_id',$request->get('uid'))
            ->select('users.id as user_id','users.avator as avator','users.name as author','category.id as cate_id','category.name as cate_name', 'questions.title as title','questions.id as question_id','questions.comments as comments','questions.views as views', 'questions.content as content','questions.created_at as created_at')
            ->orderBy('questions.created_at','desc')
            ->paginate('15');
        //问答总数
        $this->countQuestion = QuestionModel::where('user_id',$request->get('uid'))->count();
        //视频
        $this->videos = DB::table('videos')
            ->leftjoin('users', 'videos.user_id', '=', 'users.id')
            ->where('videos.status','=','1')
            ->where('users.id','=',$request->get('uid'))
            ->select('videos.id as id',
                'videos.title as title',
                'users.id as user_id',
                'users.name as author',
                'videos.thumb as thumb',
                'videos.hits as hits',
                'videos.comments as comments',
                'videos.created_at as created_at'
            )
            ->orderBy('videos.created_at','desc')
            ->paginate('16');
        $this->countVideo =  DB::table('videos')->leftjoin('users', 'videos.user_id', '=', 'users.id')->where('videos.status','=','1')->where('users.id','=',$request->get('uid'))->count();
        //最近访客 获取最近8位访客
        $this->recents = DB::table('visitors')
            ->leftjoin('users', 'visitors.visitor_id', '=', 'users.id')
            ->where('visitors.user_id','=',$request->get('uid'))
            ->select(
                'users.id as user_id',
                'users.avator as avator',
                'users.name as user_name',
                'users.avator as user_avator',
                'visitors.visitor_time as visitor_time'
            )
            ->orderBy('visitors.visitor_time','desc')
            ->paginate('8');
        //关注的话题
        $this->topics = DB::table('attentions')
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
        $this->countTopics = DB::table('attentions')
            ->leftjoin('tags', 'attentions.source_id', '=', 'tags.id')
            ->where('attentions.user_id','=',$request->get('uid'))
            ->where('attentions.source_type','=','3')->count();
        //粉丝用户
        $this->fans = DB::table('attentions')
            ->leftjoin('users', 'attentions.user_id', '=', 'users.id')
            ->where('attentions.source_type','=','1')
            ->where('attentions.source_id','=',$request->get('uid'))
            ->select('users.id as user_id','users.name as name','users.avator as avator')->orderBy('attentions.created_at','desc')->paginate('20');
        //粉丝总数
        $this->countFans = DB::table('attentions')
            ->leftjoin('users', 'attentions.user_id', '=', 'users.id')
            ->where('attentions.source_type','=','1')
            ->where('attentions.source_id','=',$request->get('uid'))->count();
        //关注的用户
        $this->topicUsers = DB::table('attentions')
            ->leftjoin('users', 'attentions.source_id', '=', 'users.id')
            ->where('attentions.source_type','=','1')
            ->where('attentions.user_id','=',$request->get('uid'))
            ->select('users.id as user_id','users.name as name','users.avator as avator')->orderBy('attentions.created_at','desc')->paginate('20');
        //关注总人数
        $this->countUsers = DB::table('attentions')
            ->leftjoin('users', 'attentions.source_id', '=', 'users.id')
            ->where('attentions.source_type','=','1')
            ->where('attentions.user_id','=',$request->get('uid'))->count();
    }

    //个人主页
    public function index()
    {
        //是否关注
        if(empty(Auth::id()))
        {
            $this->islooked = false;
        }else{
            //查看该用户是否已经关注该主页用户
            if(AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$this->uid,'source_type'=>'1'])->exists())
            {
                //关注了该用户
                $this->islooked = true;
            }else{
                $this->islooked = false;
            }
        }
    	return view('ask.home.post',[
    	    'userinfo'=>$this->userinfo,
            'datas'=>$this->posts,
            'province'=>$this->province,
            'city'=>$this->city,
            'countPost'=>$this->countPost,
            'questions'=>$this->questions,
            'countQuestion'=>$this->countQuestion,
            'videos'=>$this->videos,
            'countVideo'=>$this->countVideo,
            'topicUsers'=>$this->topicUsers,
            'countUsers'=>$this->countUsers,
            'fans'=>$this->fans,
            'countFans'=>$this->countFans,
            'topics'=>$this->topics,
            'countTopics'=>$this->countTopics,
            'uid'=>$this->uid,
            'islooked'=>$this->islooked,
            'recents'=>$this->recents]);
    }
    
    public function post()
    {
        //是否关注
        if(empty(Auth::id()))
        {
            $this->islooked = false;
        }else{
            //查看该用户是否已经关注该主页用户
            if(AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$this->uid,'source_type'=>'1'])->exists())
            {
                //关注了该用户
                $this->islooked = true;
            }else{
                $this->islooked = false;
            }
        }
        return view('ask.home.post',[
            'userinfo'=>$this->userinfo,
            'province'=>$this->province,
            'city'=>$this->city,
            'datas'=>$this->posts,
            'countPost'=>$this->countPost,
            'countQuestion'=>$this->countQuestion,
            'videos'=>$this->videos,
            'countVideo'=>$this->countVideo,
            'topicUsers'=>$this->topicUsers,
            'countUsers'=>$this->countUsers,
            'fans'=>$this->fans,
            'countFans'=>$this->countFans,
            'topics'=>$this->topics,
            'countTopics'=>$this->countTopics,
            'uid'=>$this->uid,
            'islooked'=>$this->islooked,
            'recents'=>$this->recents]);
    }
    
    //问答
    public function question()
    {
        //是否关注
        if(empty(Auth::id()))
        {
            $this->islooked = false;
        }else{
            //查看该用户是否已经关注该主页用户
            if(AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$this->uid,'source_type'=>'1'])->exists())
            {
                //关注了该用户
                $this->islooked = true;
            }else{
                $this->islooked = false;
            }
        }
        return view('ask.home.question',['userinfo'=>$this->userinfo,
            'province'=>$this->province,
            'city'=>$this->city,
            'countPost'=>$this->countPost,
            'questions'=>$this->questions,
            'countQuestion'=>$this->countQuestion,
            'videos'=>$this->videos,
            'countVideo'=>$this->countVideo,
            'topicUsers'=>$this->topicUsers,
            'countUsers'=>$this->countUsers,
            'fans'=>$this->fans,
            'countFans'=>$this->countFans,
            'topics'=>$this->topics,
            'countTopics'=>$this->countTopics,
            'uid'=>$this->uid,
            'islooked'=>$this->islooked,
            'recents'=>$this->recents]);
    }
    //视频
    public function video()
    {
        //是否关注
        if(empty(Auth::id()))
        {
            $this->islooked = false;
        }else{
            //查看该用户是否已经关注该主页用户
            if(AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$this->uid,'source_type'=>'1'])->exists())
            {
                //关注了该用户
                $this->islooked = true;
            }else{
                $this->islooked = false;
            }
        }
        return view('ask.home.video',['userinfo'=>$this->userinfo,
            'province'=>$this->province,
            'city'=>$this->city,
            'countPost'=>$this->countPost,
            'questions'=>$this->questions,
            'countQuestion'=>$this->countQuestion,
            'videos'=>$this->videos,
            'countVideo'=>$this->countVideo,
            'topicUsers'=>$this->topicUsers,
            'countUsers'=>$this->countUsers,
            'fans'=>$this->fans,
            'countFans'=>$this->countFans,
            'topics'=>$this->topics,
            'countTopics'=>$this->countTopics,
            'uid'=>$this->uid,
            'islooked'=>$this->islooked,
            'recents'=>$this->recents]);
    }
    //关注的人
    public function topicUser()
    {
        //是否关注
        if(empty(Auth::id()))
        {
            $this->islooked = false;
        }else{
            //查看该用户是否已经关注该主页用户
            if(AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$this->uid,'source_type'=>'1'])->exists())
            {
                //关注了该用户
                $this->islooked = true;
            }else{
                $this->islooked = false;
            }
        }
        return view('ask.home.topicUser',[
            'userinfo'=>$this->userinfo,
            'province'=>$this->province,
            'city'=>$this->city,
            'countPost'=>$this->countPost,
            'countQuestion'=>$this->countQuestion,
            'videos'=>$this->videos,
            'countVideo'=>$this->countVideo,
            'topicUsers'=>$this->topicUsers,
            'countUsers'=>$this->countUsers,
            'fans'=>$this->fans,
            'countFans'=>$this->countFans,
            'topics'=>$this->topics,
            'countTopics'=>$this->countTopics,
            'uid'=>$this->uid,
            'islooked'=>$this->islooked,
            'recents'=>$this->recents]);
    }
    //他的粉丝
    public function topicedUser()
    {
        //是否关注
        if(empty(Auth::id()))
        {
            $this->islooked = false;
        }else{
            //查看该用户是否已经关注该主页用户
            if(AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$this->uid,'source_type'=>'1'])->exists())
            {
                //关注了该用户
                $this->islooked = true;
            }else{
                $this->islooked = false;
            }
        }
        return view('ask.home.topicedUser',[
            'userinfo'=>$this->userinfo,
            'province'=>$this->province,
            'city'=>$this->city,
            'countPost'=>$this->countPost,
            'countQuestion'=>$this->countQuestion,
            'videos'=>$this->videos,
            'countVideo'=>$this->countVideo,
            'topicUsers'=>$this->topicUsers,
            'countUsers'=>$this->countUsers,
            'fans'=>$this->fans,
            'countFans'=>$this->countFans,
            'topics'=>$this->topics,
            'countTopics'=>$this->countTopics,
            'uid'=>$this->uid,
            'islooked'=>$this->islooked,
            'recents'=>$this->recents]);

    }

    //关注的话题
    public function topics()
    {
        //是否关注
        if(empty(Auth::id()))
        {
            $this->islooked = false;
        }else{
            //查看该用户是否已经关注该主页用户
            if(AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$this->uid,'source_type'=>'1'])->exists())
            {
                //关注了该用户
                $this->islooked = true;
            }else{
                $this->islooked = false;
            }
        }
        return view('ask.home.topics',[
            'userinfo'=>$this->userinfo,
            'province'=>$this->province,
            'city'=>$this->city,
            'countPost'=>$this->countPost,
            'countQuestion'=>$this->countQuestion,
            'videos'=>$this->videos,
            'countVideo'=>$this->countVideo,
            'topicUsers'=>$this->topicUsers,
            'countUsers'=>$this->countUsers,
            'fans'=>$this->fans,
            'countFans'=>$this->countFans,
            'topics'=>$this->topics,
            'countTopics'=>$this->countTopics,
            'uid'=>$this->uid,
            'islooked'=>$this->islooked,
            'recents'=>$this->recents
        ]);

    }

    //他的回答
    public function answer(Request $request)
    {
        //是否关注
        if(empty(Auth::id()))
        {
            $this->islooked = false;
        }else{
            //查看该用户是否已经关注该主页用户
            if(AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$this->uid,'source_type'=>'1'])->exists())
            {
                //关注了该用户
                $this->islooked = true;
            }else{
                $this->islooked = false;
            }
        }
        return view('ask.home.answer',[
            'userinfo'=>$this->userinfo,
            'questions'=>$this->questions,
            'province'=>$this->province,
            'city'=>$this->city,
            'uid'=>$this->uid,
            'islooked'=>$this->islooked
        ]);
    }

    //个人主页详细信息
    public function info(Request $request)
    {
        return view('ask.home.info', [
            'userinfo'=>$this->userinfo,
            'province'=>$this->province,
            'city'=>$this->city,
            'countPost'=>$this->countPost,
            'countQuestion'=>$this->countQuestion,
            'videos'=>$this->videos,
            'countVideo'=>$this->countVideo,
            'topicUsers'=>$this->topicUsers,
            'countUsers'=>$this->countUsers,
            'fans'=>$this->fans,
            'countFans'=>$this->countFans,
            'topics'=>$this->topics,
            'countTopics'=>$this->countTopics,
            'uid'=>$this->uid,
            'islooked'=>$this->islooked,
            'recents'=>$this->recents
        ]);
    }

}
