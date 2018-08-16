<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\TagModel;
use App\Models\Common\AttentionModel;
use Illuminate\Support\Facades\DB;
use App\Models\Common\CategoryModel;

class TopicController extends Controller
{
    //首页
    public function index(Request $request)
    {
    	$tags = TagModel::where('status','1')->paginate('14');
        //今日话题
        $todayTag = TagModel::where('status','1')->orderBy('created_at','desc')->limit(1)->get()->toArray();
        //话题分类
        $cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();

    	return view('ask.topic.index',['tags'=>$tags,'todayTag'=>$todayTag,'cates'=>$cates,'cid'=>'']);
    }
    
    //话题分类筛选列表
    public function cate(Request $request)
    {
        $this->validate($request, ['cid'=>'required|numeric|exists:category,id']);
        
        $tags = TagModel::where(['cate_id'=>$request->get('cid'),'status'=>'1'])->paginate('14');
        //话题分类
        $cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
        //今日话题
        $todayTag = TagModel::where('status','1')->orderBy('created_at','desc')->limit(1)->get()->toArray();

        return view('ask.topic.index',['tags'=>$tags,'todayTag'=>$todayTag[0],'cates'=>$cates,'cid'=>$request->get('cid')]);
    }
    
    
    public function hot()
    {
    	$tags = TagModel::where('status','1')->orderBy('watchs','desc')->paginate('20');
    	return view('wenda.topic.hot',['tags'=>$tags]);
    }
    
    //话题详情
    public function detail(Request $request) 
    {
        $this->validate($request, [
    			'id'=>'required|numeric|exists:tags,id'
    	]);
        $datas = TagModel::where(['id'=>$request->get('id'),'status'=>'1'])->get();
        //相关话题
        $attenCateId = TagModel::where(['id'=>$request->get('id'),'status'=>'1'])->pluck('cate_id');
        $relateAttens = TagModel::where(['cate_id'=>$attenCateId,'status'=>'1'])->get();
        //关注该话题的人
        $attenUser = DB::table('attentions')
    		->leftjoin('users', 'attentions.user_id', '=', 'users.id')
    		->where('attentions.source_id','=',$request->get('id'))
    		->where('attentions.source_type','=','3')
    		->select('users.id as user_id',
    				'users.name as name',
    		        'users.avator as avator'
    		    )
    		->orderBy('users.created_at','asc')
    		->limit('15')->get()->toArray();
        //关注该话题的总人数
        $attenCount = DB::table('attentions')->where('source_type','3')->where('source_id',$request->get('id'))->count();
        return view('ask.topic.detail',['datas'=>$datas[0],'countposts'=>self::countContent($request->get('id'))['countposts'],'countquestions'=>self::countContent($request->get('id'))['countquestions'],'countvideos'=>self::countContent($request->get('id'))['countvideos'],'relateAttens'=>$relateAttens,'attenUsers'=>$attenUser,'attenCount'=>$attenCount,'tid'=>$request->get('id')]);
    }

    //该话题文章
    public function post(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:tags,id'
        ]);
        $posts = DB::table('posts')
            ->leftjoin('users', 'posts.user_id', '=', 'users.id')
            ->leftjoin('other_tag', 'posts.id', '=', 'other_tag.source_id')
            ->leftjoin('category', 'category.id', '=', 'posts.cate_id')
            ->where('other_tag.tag_id','=',$request->get('id'))
            ->where('other_tag.source_type','=','1')
            ->where('posts.status','=','1')
            ->select('posts.id as post_id',
                'posts.title as title',
                'category.id as cate_id',
                'category.name as cate_name',
                'users.name as author',
                'posts.user_id as user_id',
                'posts.excerpt as excerpt',
                'posts.comments as countcomment',
                'posts.content as content',
                'posts.thumb as thumb',
                'posts.created_at as created_at',
                'posts.comments as comments',
                'posts.hits as hits',
                'users.avator as avator'
            )
            ->orderBy('posts.created_at','desc')
            ->paginate('15');
        $datas = TagModel::where(['id'=>$request->get('id'),'status'=>'1'])->get();
        //关注该话题的人
        $attenUser = DB::table('attentions')
            ->leftjoin('users', 'attentions.user_id', '=', 'users.id')
            ->where('attentions.source_id','=',$request->get('id'))
            ->where('attentions.source_type','=','3')
            ->select('users.id as user_id',
                'users.name as name',
                'users.avator as avator'
            )
            ->orderBy('users.created_at','asc')
            ->limit('15')->get()->toArray();
        //关注该话题的总人数
        $attenCount = DB::table('attentions')->where('source_type','3')->where('source_id',$request->get('id'))->count();
        return view('ask.topic.post',['datas'=>$datas[0],'posts'=>$posts,'countposts'=>self::countContent($request->get('id'))['countposts'],'countquestions'=>self::countContent($request->get('id'))['countquestions'],'countvideos'=>self::countContent($request->get('id'))['countvideos'],'attenUsers'=>$attenUser,'attenCount'=>$attenCount,'tid'=>$request->get('id')]);
    }

    //该话题问答
    public function question(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:tags,id'
        ]);
        //问答
        $questions = DB::table('questions')
            ->leftjoin('users', 'users.id', '=', 'questions.user_id')
            ->leftjoin('other_tag', 'other_tag.source_id', '=', 'questions.id')
            ->leftjoin('category', 'questions.cate_id', '=', 'category.id')
            ->where('other_tag.tag_id','=',$request->get('id'))
            ->where('other_tag.source_type','=','2')
            ->select('users.id as user_id','users.avator as avator','users.name as author','category.id as cate_id','category.name as cate_name', 'questions.title as title','questions.id as question_id','questions.comments as comments','questions.views as views', 'questions.content as content','questions.created_at as created_at')
            ->orderBy('questions.created_at','desc')
            ->paginate('15');
        $datas = TagModel::where(['id'=>$request->get('id'),'status'=>'1'])->get();
        //关注该话题的人
        $attenUser = DB::table('attentions')
            ->leftjoin('users', 'attentions.user_id', '=', 'users.id')
            ->where('attentions.source_id','=',$request->get('id'))
            ->where('attentions.source_type','=','3')
            ->select('users.id as user_id',
                'users.name as name',
                'users.avator as avator'
            )
            ->orderBy('users.created_at','asc')
            ->limit('15')->get()->toArray();
        //关注该话题的总人数
        $attenCount = DB::table('attentions')->where('source_type','3')->where('source_id',$request->get('id'))->count();
        return view('ask.topic.question',['datas'=>$datas[0],'countposts'=>self::countContent($request->get('id'))['countposts'],'countquestions'=>self::countContent($request->get('id'))['countquestions'],'countvideos'=>self::countContent($request->get('id'))['countvideos'],'questions'=>$questions,'attenUsers'=>$attenUser,'attenCount'=>$attenCount,'tid'=>$request->get('id')]);
    }

    //该话题文章
    public function video(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:tags,id'
        ]);
        //该话题视频
        $videos = DB::table('videos')
            ->leftjoin('users', 'users.id', '=', 'videos.user_id')
            ->leftjoin('other_tag', 'other_tag.source_id', '=', 'videos.id')
            ->leftjoin('category', 'videos.cate_id', '=', 'category.id')
            ->where('other_tag.tag_id','=',$request->get('id'))
            ->where('other_tag.source_type','=','3')
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
        $datas = TagModel::where(['id'=>$request->get('id'),'status'=>'1'])->get();
        //关注该话题的人
        $attenUser = DB::table('attentions')
            ->leftjoin('users', 'attentions.user_id', '=', 'users.id')
            ->where('attentions.source_id','=',$request->get('id'))
            ->where('attentions.source_type','=','3')
            ->select('users.id as user_id',
                'users.name as name',
                'users.avator as avator'
            )
            ->orderBy('users.created_at','asc')
            ->limit('15')->get()->toArray();
        //关注该话题的总人数
        $attenCount = DB::table('attentions')->where('source_type','3')->where('source_id',$request->get('id'))->count();
        return view('ask.topic.video',['datas'=>$datas[0],'countposts'=>self::countContent($request->get('id'))['countposts'],'countquestions'=>self::countContent($request->get('id'))['countquestions'],'countvideos'=>self::countContent($request->get('id'))['countvideos'],'videos'=>$videos,'attenUsers'=>$attenUser,'attenCount'=>$attenCount,'tid'=>$request->get('id')]);

    }

    private static function countContent($id)
    {
        //该话题文章总数
        $countPosts = DB::table('posts')
            ->leftjoin('other_tag', 'posts.id', '=','other_tag.source_id' )
            ->where('other_tag.source_type','=','1')
            ->where('other_tag.tag_id','=',$id)
            ->where('posts.status','=','1')
            ->count();
        //该话题问答总数
        $countQuestions = DB::table('questions')
            ->leftjoin('other_tag', 'questions.id', '=','other_tag.source_id' )
            ->where('other_tag.source_type','=','2')
            ->where('other_tag.tag_id','=',$id)
            ->count();
        //该话题视频总数
        $countVideos = DB::table('videos')
            ->leftjoin('other_tag', 'videos.id', '=','other_tag.source_id' )
            ->where('other_tag.source_type','=','3')
            ->where('other_tag.tag_id','=',$id)
            ->where('videos.status','=','1')
            ->count();
        return ['countposts'=>$countPosts,'countquestions'=>$countQuestions,'countvideos'=>$countVideos];
    }
}
