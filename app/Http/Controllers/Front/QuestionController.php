<?php

namespace App\Http\Controllers\Front;

use App\Models\Common\SupportModel;
use App\Models\Common\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\TagModel;
use App\Models\Common\CategoryModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Common\QuestionModel;
use App\Models\Common\QuestionTagModel;
use Illuminate\Support\Facades\DB;
use App\Models\Front\CollectionModel;
use App\Models\Common\AnswerModel;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    //问答列表
    public function index()
    {
        //分类
    	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
        //话题
        $tags = TagModel::orderBy('watchs','desc')->limit('6')->get();
        //问答
    	$questions = DB::table('questions')
				    	->leftjoin('users', 'users.id', '=', 'questions.user_id')
                        ->leftjoin('category', 'questions.cate_id', '=', 'category.id')
				    	->select('users.id as user_id','users.avator as avator','users.name as author','category.id as cate_id','category.name as cate_name', 'questions.title as title','questions.id as question_id','questions.comments as comments','questions.views as views', 'questions.content as content','questions.created_at as created_at')
						->orderBy('questions.created_at','desc')		    	
    					->paginate('15');
        //热门用户
        $hotUsers = UserModel::limit(10)->get();
    	return view('ask.question.index',['cates'=>$cates,'questions'=>$questions,'tags'=>$tags,'tid'=>'','cid'=>'','hotUsers'=>$hotUsers]);
    }
    
    //新增问答
    public function create()
    {
    	$tags = TagModel::all();
    	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    	return view('ask.question.create',[
    			'cates'=>$cates,
    			'tags'=>$tags
    	]);
    }
    
    public function store(Request $request)
    {
	    $validator = Validator::make($request->all(),[
	    		'cid'=>'required|numeric|exists:category,id',
	    		'title'=>'required|min:2',
	    		'content'=>'required|min:10',
	    	],[
	    		'required'=>':attribute为必填项',
	    		'min'=>':attribute至少 :min个字节长',
	    		'max'=>':attribute超出限制',
	    	],[
	    		'cid'=>'分类',
	    		'title'=>'标题',
	    		'content'=>'内容',
	    	]);
	    	if($validator->fails())
	    	{
	    		return redirect()->back()->withErrors($validator)->withInput();
	    	}
	    
	    	$data = [
	    			'user_id'  => Auth::user()->id,
	    			'cate_id'  => $request->get('cid'),
	    			'title'    => $request->get('title'),
	    			'content'  => $request->get('content'),
	    	];
	    	$questionId = QuestionModel::create($data);
	    	//tags不为空
	    	if(!empty($request->get('tags')[0]))
	    	{
	    		
	    		//只取前5个标签存入
	    		$tmpArr = array_only($request->get('tags'), ['0','1','2','3','4']);
	    		
	    		foreach($tmpArr as $tag)
	    		{
                    //话题问答总数自增一
                    DB::table("tags")->where('id',$tag)->increment("questions");
	    			QuestionTagModel::updateOrCreate([
	    					'questions_id'=>$questionId->id,
	    					'tags_id'=>$tag
	    			],[
	    					'questions_id'=>$questionId->id,
	    					'tags_id'=>$tag
	    			]);
	    		}
	    	}
    	return redirect('/question');
	    	
    }
    //详情页
    public function detail(Request $request) 
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:questions,id'
    	]);
        //浏览数自增
        DB::table("questions")->where('id',$request->get('id'))->increment("views");
    	//查询问答
    	$datas = DB::table('questions')
    	->leftjoin('users', 'questions.user_id', '=', 'users.id')
    	->leftjoin('category', 'questions.cate_id', '=', 'category.id')
    	->where('questions.id','=',$request->get('id'))
    	->select('questions.id as question_id',
    			'questions.title as title',
    			'users.name as author',
                'users.avator as avator',
    			'questions.user_id as user_id',
    			'category.name as catename',
    			'questions.cate_id as cateid',
    			'questions.content as content',
    			'questions.created_at as created_at',
    			'questions.comments as countcomment'
    			)->orderBy('questions.created_at','desc')->get();
    	//标签
    	$tagss = DB::table('question_tag')
    			->leftjoin('tags', 'question_tag.tags_id', '=', 'tags.id')
    			->where('question_tag.questions_id','=',$request->get('id'))
    			->select(
    					'tags.name as name',
    					'tags.id as id'
    					)
    			->orderBy('tags.created_at','desc')
    			->paginate('5');
    			//评论内容
    	$answers = DB::table('answers')
    			->leftjoin('users', 'answers.user_id', '=', 'users.id')
    			->where('answers.question_id','=',$request->get('id'))
    			->select('answers.id as answer_id',
    					'answers.user_id as user_id',
    					'answers.id as answer_id',
    					'answers.content as content',
    					'answers.to_user_id as to_user_id',
    					'answers.created_at as created_at',
    					'answers.status as status',
    					'users.name as commentator',
    					'users.avator as avator')
    			->orderBy('answers.created_at','desc')
    			->paginate('15');
        //点赞数
        $supports = SupportModel::where(['source_id'=>$request->get('id'),'source_type'=>'2','rating'=>'1'])->count();
    	//是否收藏
    	if(!empty(Auth::id()))
    		{
    		    //是否收藏
    			if(CollectionModel::where(['user_id'=>Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'2'])->exists())
    			{
    					$isCollected = true;
    			}else{
    					$isCollected = false;
    			}

                //是否点赞
                if(SupportModel::where(['user_id'=>Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'2','rating'=>'1'])->exists())
                {
                    $isSupported = true;
                }else{
                    $isSupported = false;
                }
    		}else{
    			$isCollected = false;
                $isSupported = false;
    		}
    	return view('ask.question.detail',['datas'=>$datas[0],'tagss'=>$tagss,'answers'=>$answers,'supports'=>$supports,'id'=>$request->get('id'),'isCollected'=>$isCollected,'isSupported'=>$isSupported]);
    }
    
    //问答收藏
    public function collect(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:questions,id'
    	]);
    	//处理收藏
    	if(empty(Auth::id()))
    	{
    		$data = [
    				'code'=>'2',
    				'msg'=>'收藏失败，请先登录'
    		];
    		return $data;
    	}
    	if(!CollectionModel::where(['user_id' => Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'2'])->exists())
    	{
    		CollectionModel::updateOrCreate(
    				array('user_id' => Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'2'),
    				array('user_id' => Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'2')
    				);
    		$data = [
    				'code'=>'1',
    				'msg'=>'收藏成功'
    		];
    		return $data;
    	}
    	$data = [
    			'code'=>'0',
    			'msg'=>'已收藏过该文章'
    	];
    	return $data;
    }
    
    //取消收藏
    public function collectCancel(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric'
    	]);
    	CollectionModel::where(['user_id' => Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'2'])->delete();
    	$data = [
    			'code'=>'1',
    			'msg'=>'取消收藏'
    	];
    	return $data;
    }
    // 分类
    public function cate(Request $request)
    {
        $this->validate($request, ['cid'=>'required|numeric|exists:category,id']);
        $questions = DB::table('questions')
            ->leftjoin('users', 'users.id', '=', 'questions.user_id')
            ->leftjoin('category', 'questions.cate_id', '=', 'category.id')
            ->where('questions.cate_id','=',$request->get('cid'))
            ->select('users.id as user_id','users.avator as avator','users.name as author','category.id as cate_id','category.name as cate_name', 'questions.title as title','questions.id as question_id','questions.comments as comments','questions.views as views','questions.content as content','questions.created_at as created_at')
            ->orderBy('questions.created_at','desc')
            ->paginate('15');
        //查询分类
        $cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
        //话题列表
        $tags = TagModel::all();
        //热门用户
        $hotUsers = UserModel::limit(10)->get();
        return view('ask.question.index',['questions'=>$questions,'cates'=>$cates,'tags'=>$tags,'tid'=>'','cid'=>$request->get('cid'),'hotUsers'=>$hotUsers]);
    }

    //待回答分类
    public function remainCate(Request $request)
    {
    	$this->validate($request, [
    			'cid'=>$request->get('cid')?'required|numeric|exists:category,id':'',
    	]);
        if($request->get('cid'))
        {
            $questions = DB::table('questions')
                ->leftjoin('users', 'questions.user_id', '=', 'users.id')
                ->leftjoin('category', 'questions.cate_id', '=', 'category.id')
                ->where( 'questions.cate_id',$request->get('cid'))
                ->where('questions.comments','<','1')
                ->select(
                    'users.id as user_id',
                    'users.name as author',
                    'users.avator as avator',
                    'category.id as cate_id',
                    'category.name as cate_name',
                    'questions.title as title',
                    'questions.id as question_id',
                    'questions.comments as comments',
                    'questions.views as views',
                    'questions.content as content',
                    'questions.created_at as created_at'
                )
                ->orderBy('questions.created_at','desc')
                ->paginate('15');
        }else{
            $questions = DB::table('questions')
                ->leftjoin('users', 'users.id', '=', 'questions.user_id')
                ->leftjoin('category', 'questions.cate_id', '=', 'category.id')
                ->where('questions.comments','<','1')
                ->select('users.id as user_id','users.name as author','users.avator as avator','category.id as cate_id','category.name as cate_name',  'questions.title as title','questions.id as question_id' ,'questions.comments as comments','questions.views as views','questions.content as content','questions.created_at as created_at')
                ->orderBy('questions.created_at','desc')
                ->paginate('15');
        }
        //话题列表
        $tags = TagModel::limit('6')->get();
        //分类列表
        $cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
        //热门用户
        $hotUsers = UserModel::limit(10)->get();
        return view('ask.question.remain',['questions'=>$questions,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags,'hotUsers'=>$hotUsers]);
    }

    // 热门分类
    public function hotCate(Request $request)
    {
        $this->validate($request, [
            'cid'=>$request->get('cid')?'required|numeric|exists:category,id':''
        ]);
        if($request->get('cid'))
        {
            $questions = DB::table('questions')
            ->leftjoin('users', 'users.id', '=', 'questions.user_id')
            ->leftjoin('category', 'questions.cate_id', '=', 'category.id')
            ->where( 'questions.cate_id',$request->get('cid'))
            ->select('users.id as user_id','users.avator as avator','users.name as author','category.id as cate_id','category.name as cate_name', 'questions.title as title','questions.id as question_id','questions.comments as comments','questions.views as views','questions.content as content','questions.created_at as created_at')
            ->orderBy('questions.likes','desc')
            ->paginate('15');
        }else{
            $questions = DB::table('questions')
            ->leftjoin('users', 'users.id', '=', 'questions.user_id')
            ->leftjoin('category', 'questions.cate_id', '=', 'category.id')
            ->select('users.id as user_id','users.avator as avator','users.name as author','category.id as cate_id','category.name as cate_name', 'questions.title as title','questions.id as question_id','questions.comments as comments','questions.views as views','questions.content as content','questions.created_at as created_at')
            ->orderBy('questions.likes','desc')
            ->paginate('15');
        }
        //查询分类
        $cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
        //话题列表
        $tags = TagModel::limit('6')->get();
        //热门用户
        $hotUsers = UserModel::limit(10)->get();
        return view('ask.question.hot',['questions'=>$questions,'cates'=>$cates,'tags'=>$tags,'tid'=>'','cid'=>$request->get('cid'),'hotUsers'=>$hotUsers]);
    }
    //问答分类筛选列表
    public function tag(Request $request)
    {
    	$this->validate($request, [
    			'cid'=>$request->get('cid') != null ?'required|numeric|exists:category,id':'',
    			'tid'=>'required|numeric|exists:tags,id'
    	]);
    	//查询分类
    	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    	//分类为空 只查询包含该tag属性的文章
    	if(empty($request->get('cid')))
    	{
    		//该标签的文章
    		$questions = DB::table('questions')
    		->leftjoin('users', 'questions.user_id', '=', 'users.id')
    		->leftjoin('question_tag', 'questions.id', '=', 'question_tag.questions_id')
    		->where('question_tag.tags_id','=',$request->get('tid'))
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
    		$tags = TagModel::all();
    	}else{
    		$questionIds  = DB::table('questions')->where('cate_id','=',$request->get('cid'))->pluck('id');
    		//查询该分类下面的标签问答
    		$tagIds = DB::table('question_tag')
    		->leftjoin('questions', 'question_tag.questions_id', '=', 'questions.id')
    		->whereIn('question_tag.questions_id', $questionIds)
    		->select('question_tag.tags_id as tag_id')->pluck('tag_id')->toArray();
    		//去重
    		$tagIds = array_unique($tagIds);
    		$tags = DB::table('tags')
    		->whereIn('tags.id', $tagIds)
    		->get();
    		//查询该分类下面的标签问答
    		$questions = DB::table('questions')
    		->leftjoin('users', 'questions.user_id', '=', 'users.id')
    		->leftjoin('question_tag', 'questions.id', '=', 'question_tag.questions_id')
    		->where('question_tag.tags_id','=',$request->get('tid'))
    		->where('questions.cate_id','=',$request->get('cid'))
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
    	}
    	return view('wenda.question.index',['questions'=>$questions,'cates'=>$cates,'tags'=>$tags,'cid'=>$request->get('cid'),'tid'=>$request->get('tid')]);
    }
    
    
    //添加回答
    public function answer(Request $request)
    {
    	$this->validate($request, [
    			'answer'=>'required|min:1',
                'captcha'=>'required',
    			'question_id'=>'required|exists:questions,id',
    			'to_user_id'=>'sometimes|exists:answers,user_id',
    			'answer_id'=>'sometimes|exists:answers,id',
    			'user_id'=>'required|exists:users,id'
    	],[
            'required'=>':attribute 不能为空'
        ],[
            'captcha'=>'验证码'
        ]);
        //验证码验证
        if($request->get('captcha') !== Session::get('code'))
        {
            return redirect()->back()->withErrors(['captcha'=>'验证码错误'])->withInput();
        }
    	$result = AnswerModel::create([
    			'user_id'=>$request->get('user_id'),
    			'question_id'=>$request->get('question_id'),
    			'content'=>$request->get('answer'),
    			'to_user_id'=>$request->get('to_user_id')
    	]);
    	//评论数加一
    	QuestionModel::where('id','=',$request->get('question_id'))->increment("comments");
    	if($result)
    	{
    		return redirect()->action('Front\QuestionController@detail',['id'=>$request->get('question_id')]);
    	}else{
    		return redirect()->back();
    	}
    }
    
    //问答删除
    public function del(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:questions,id'
    	]);
    	$result = DB::table('questions')->where([
    			'id'=>$request->get('id'),
    			'user_id'=>Auth::id()
    	])->delete();
        // 标签问答删除
        DB::table('tags')->leftjoin('question_tag', 'question_tag.tags_id', '=', 'tags.id')->where('question_tag.questions_id',$request->get('id'))->where('tags.questions','>', 0)->decrement('questions');
    	if($result)
    	{
    		$data = [
    				'code'=>'1',
    				'msg'=>'删除成功'
    		];
    	}else{
    		$data = [
    				'code'=>'0',
    				'msg'=>'删除失败'
    		];
    	}
    	return $data;
    }
    
    //问答编辑
    public function edit(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:questions,id'
    	]);
    	$datas = QuestionModel::where([
    			'id'=>$request->get('id'),
    			'user_id'=>Auth::id()
    	])->get();
    	//该问答选中的标签
    	$selectedTags = DB::table('question_tag')
    	->leftjoin('tags', 'question_tag.tags_id', '=', 'tags.id')
    	->where('question_tag.questions_id','=',$request->get('id'))
        ->pluck('tags.id as id')->toArray();
    	$tags = TagModel::all();
    	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    	return view('ask.question.edit',[
    			'cates'=>$cates,
    			'tags'=>$tags,
    			'selectedTags'=>$selectedTags,
    			'datas'=>$datas[0]
    	]);
    }
    //更新保存
    public function update(Request $request)
    {
    	$validator = Validator::make($request->all(),[
    			'id'=>'required|numeric|exists:questions,id',
    			'cid'=>'required|numeric|exists:category,id',
    			'title'=>'required|min:2',
    			'content'=>'required|min:10',
    			'tags.*'=>'sometimes|max:18',
    	],[
    			'required'=>':attribute为必填项',
    			'min'=>':attribute至少 :min个字节长',
    			'max'=>':attribute超出限制',
    	],[
    			'cid'=>'分类',
    			'title'=>'标题',
    			'content'=>'内容',
    			'tags.*'=>'标签',
    	]);
    	if($validator->fails())
    	{
    		return redirect()->back()->withErrors($validator)->withInput();
    	}
    	$data = [
    			'user_id'  => Auth::user()->id,
    			'cate_id'  => $request->get('cid'),
    			'title'    => trim($request->get('title')),
    			'content'  => $request->get('content'),
    	];
    	//更新
    	$questionId = QuestionModel::updateOrCreate(array('id' => $request->get('id')), $data);
        //话题文章总数自减一
        $tagIds = QuestionTagModel::where(['questions_id'=>$request->get('id')])->pluck('tags_id');
        if(!($tagIds->isEmpty()))
        {
            foreach ($tagIds as $k)
            {
                DB::table('tags')->where('id', $k)->where('questions', '>', 0)->decrement("questions");
            }
        }
    	//清除原有标签
    	QuestionTagModel::where('questions_id',$request->get('id'))->delete();
    	//新增标签
    	if(!empty($request->get('tags')[0]))
    	{
    		//只取前5个标签存入
    		$tmpArr = array_only($request->get('tags'), ['0','1','2','3','4']);

    		foreach($tmpArr as $tag)
    		{
                //话题问答总数自增一
                DB::table('tags')->where('id',$tag)->increment("questions");
    			QuestionTagModel::updateOrCreate([
    					'questions_id'=>$questionId->id,
    					'tags_id'=>$tag
    			],[
    					'questions_id'=>$questionId->id,
    					'tags_id'=>$tag
    			]);
    		}
    	}
    	return redirect('/question');
    }
    
}
