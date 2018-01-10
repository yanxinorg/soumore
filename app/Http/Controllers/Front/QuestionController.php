<?php

namespace App\Http\Controllers\Front;

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

class QuestionController extends Controller
{
    //问答列表
    public function index()
    {
    	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    	$tags = TagModel::all();
    	$questions = DB::table('questions')
				    	->join('users', 'users.id', '=', 'questions.user_id')
				    	->select('users.id as user_id','users.name as user_name', 'questions.title as title','questions.id as question_id', 'questions.content as content','questions.created_at as created_at')
						->orderBy('questions.created_at','desc')		    	
    					->paginate('15');
    	return view('wenda.question.index',['cates'=>$cates,'questions'=>$questions,'tags'=>$tags,'tid'=>'','cid'=>'']);
    }
    
    //新增问答
    public function create()
    {
    	$tags = TagModel::all();
    	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    	return view('wenda.question.create',[
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
    	//查询文章
    	$datas = DB::table('questions')
    	->join('users', 'questions.user_id', '=', 'users.id')
    	->join('category', 'questions.cate_id', '=', 'category.id')
    	->where('questions.id','=',$request->get('id'))
    	->select('questions.id as question_id',
    			'questions.title as title',
    			'users.name as author',
    			'questions.user_id as user_id',
    			'category.name as catename',
    			'questions.cate_id as cateid',
    			'questions.content as content',
    			'questions.created_at as created_at',
    			'questions.comments as countcomment'
    			)->orderBy('questions.created_at','desc')->get();
    	//标签
    	$tagss = DB::table('question_tag')
    			->join('tags', 'question_tag.tags_id', '=', 'tags.id')
    			->where('question_tag.questions_id','=',$request->get('id'))
    			->select(
    					'tags.name as name',
    					'tags.id as id'
    					)
    			->orderBy('tags.created_at','desc')
    			->paginate('5');
    			//评论内容
    	$answers = DB::table('answers')
    			->join('users', 'answers.user_id', '=', 'users.id')
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
    			->orderBy('answers.created_at','asc')
    			->paginate('15');
    	//是否收藏
    	if(!empty(Auth::id()))
    		{
    			if(CollectionModel::where(['user_id'=>Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'2'])->exists())
    			{
    					$isCollected = true;
    			}else{
    					$isCollected = false;
    			}
    		}else{
    			$isCollected = false;
    		}
    	return view('wenda.question.detail',['datas'=>$datas[0],'tagss'=>$tagss,'answers'=>$answers,'id'=>$request->get('id'),'isCollected'=>$isCollected]);
    }
    
    //文章收藏
    public function collect(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric'
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
    
    //最新问答
    public function latest(Request $request)
    {
    	$this->validate($request, [
    			'cid'=>$request->get('cid') != null ?'required|numeric|exists:category,id':'',
    			'tid'=>$request->get('tid') != null ?'required|numeric|exists:tags,id':'',
    	]);
    	//分类和标签都不为空
    	if(!empty($request->get('cid')) && !empty($request->get('tid')))
    	{
    		//查询
    		$questions = DB::table('questions')
    		->join('users', 'questions.user_id', '=', 'users.id')
    		->join('question_tag', 'questions.id', '=', 'question_tag.questions_id')
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
    		$questionIds  = DB::table('questions')->where('cate_id','=',$request->get('cid'))->pluck('id');
    		//查询该分类下面的标签文章
    		$tags = DB::table('question_tag')
    				->join('questions', 'question_tag.questions_id', '=', 'questions.id')
    				->join('tags', 'question_tag.tags_id', '=', 'tags.id')
    				->whereIn('question_tag.questions_id', $questionIds)
    				->select('tags.id as id','tags.name as name')->get();
    		$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    		return view('wenda.question.index',['questions'=>$questions,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    	}
    	//分类不为空,标签为空
    	if(!empty($request->get('cid')))
    	{
    		$questions = DB::table('questions')
    		->join('users', 'questions.user_id', '=', 'users.id')
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
    		$questionIds  = DB::table('questions')->where('cate_id','=',$request->get('cid'))->pluck('id');
    		//查询该分类下面的标签文章
    		$tags = DB::table('question_tag')
    				->join('questions', 'question_tag.questions_id', '=', 'questions.id')
    				->join('tags', 'question_tag.tags_id', '=', 'tags.id')
    				->whereIn('question_tag.questions_id', $questionIds)
    				->select('tags.id as id','tags.name as name')->get();
    		$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    		return view('wenda.question.index',['questions'=>$questions,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    	}
    	//标签不为空,分类为空
    	if(!empty($request->get('tid')))
    	{
    		$questions = DB::table('questions')
    		->join('users', 'questions.user_id', '=', 'users.id')
    		->join('question_tag', 'questions.id', '=', 'question_tag.questions_id')
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
    		$questionIds  = DB::table('questions')->where('cate_id','=',$request->get('cid'))->pluck('id');
    		//查询该分类下面的标签问答
    		$tags = DB::table('question_tag')
    				->join('questions', 'question_tag.questions_id', '=', 'questions.id')
    				->join('tags', 'question_tag.tags_id', '=', 'tags.id')
    				->whereIn('question_tag.questions_id', $questionIds)
    				->select('tags.id as id','tags.name as name')->get();
    		$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    		return view('wenda.question.index',['questions'=>$questions,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    	}
    	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    	$tags = TagModel::all();
    	$questions = DB::table('questions')
				    ->join('users', 'users.id', '=', 'questions.user_id')
				    ->select('users.id as user_id','users.name as user_name', 'questions.title as title','questions.id as question_id', 'questions.content as content','questions.created_at as created_at')
				    ->paginate('15');
    	return view('wenda.question.index',[
    		'questions'=>$questions,
    		'cates'=>$cates,
    		'tags'=>$tags,
    		'tid'=>'',
    		'cid'=>''
    	]);
    }
    
    //最热问答
    public function hottest(Request $request)
    {
    	$this->validate($request, [
    			'cid'=>$request->get('cid') != null ?'required|numeric|exists:category,id':'',
    			'tid'=>$request->get('tid') != null ?'required|numeric|exists:tags,id':'',
    	]);
    	//分类和标签都不为空
    	if(!empty($request->get('cid')) && !empty($request->get('tid')))
    	{
    		//查询
    		$questions = DB::table('questions')
    		->join('users', 'questions.user_id', '=', 'users.id')
    		->join('question_tag', 'questions.id', '=', 'question_tag.questions_id')
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
    		->orderBy('questions.views','desc')
    		->orderBy('questions.created_at','desc')
    		->paginate('15');
    		$questionIds  = DB::table('questions')->where('cate_id','=',$request->get('cid'))->pluck('id');
    				//查询该分类下面的标签文章
    		$tags = DB::table('question_tag')
    				->join('questions', 'question_tag.questions_id', '=', 'questions.id')
    				->join('tags', 'question_tag.tags_id', '=', 'tags.id')
    				->whereIn('question_tag.questions_id', $questionIds)
    				->select('tags.id as id','tags.name as name')->get();
    		$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    		return view('wenda.question.index',['questions'=>$questions,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    	}
    	//分类不为空,标签为空
    	if(!empty($request->get('cid')))
    	{
    		$questions = DB::table('questions')
    		->join('users', 'questions.user_id', '=', 'users.id')
    		->where('questions.cate_id','=',$request->get('cid'))
    		->select(
    				'users.id as user_id',
    				'users.name as user_name',
    				'questions.title as title',
    				'questions.id as question_id',
    				'questions.content as content',
    				'questions.created_at as created_at'
    				)
    		->orderBy('questions.views','desc')
    		->orderBy('questions.created_at','desc')
    		->paginate('15');
    		$questionIds  = DB::table('questions')->where('cate_id','=',$request->get('cid'))->pluck('id');
    				//查询该分类下面的标签文章
    		$tags = DB::table('question_tag')
    				->join('questions', 'question_tag.questions_id', '=', 'questions.id')
    				->join('tags', 'question_tag.tags_id', '=', 'tags.id')
    				->whereIn('question_tag.questions_id', $questionIds)
    				->select('tags.id as id','tags.name as name')->get();
    		$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    		return view('wenda.question.index',['questions'=>$questions,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    	}
    	//标签不为空,分类为空
    	if(!empty($request->get('tid')))
    	{
    		$questions = DB::table('questions')
    		->join('users', 'questions.user_id', '=', 'users.id')
    		->join('question_tag', 'questions.id', '=', 'question_tag.questions_id')
    		->where('question_tag.tags_id','=',$request->get('tid'))
    		->select(
    				'users.id as user_id',
    				'users.name as user_name',
    				'questions.title as title',
    				'questions.id as question_id',
    				'questions.content as content',
    				'questions.created_at as created_at'
    				)
    		->orderBy('questions.views','desc')
    		->orderBy('questions.created_at','desc')
    		->paginate('15');
    		$questionIds  = DB::table('questions')->where('cate_id','=',$request->get('cid'))->pluck('id');
    				//查询该分类下面的标签问答
    		$tags = DB::table('question_tag')
    				->join('questions', 'question_tag.questions_id', '=', 'questions.id')
    				->join('tags', 'question_tag.tags_id', '=', 'tags.id')
    				->whereIn('question_tag.questions_id', $questionIds)
    				->select('tags.id as id','tags.name as name')->get();
    		$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    		return view('wenda.question.index',['questions'=>$questions,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    	}
    	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    	$tags = TagModel::all();
    	$questions = DB::table('questions')
    	->join('users', 'users.id', '=', 'questions.user_id')
    	->select('users.id as user_id','users.name as user_name', 'questions.title as title','questions.id as question_id', 'questions.content as content','questions.created_at as created_at')
    	->orderBy('questions.views','desc')
    	->paginate('15');
    	return view('wenda.question.index',[
    			'questions'=>$questions,
    			'cates'=>$cates,
    			'tags'=>$tags,
    			'tid'=>'',
    			'cid'=>''
    	]);
    }
    
    //待回答
    public function unanswered(Request $request)
    {
    	$this->validate($request, [
    			'cid'=>$request->get('cid') != null ?'required|numeric|exists:category,id':'',
    			'tid'=>$request->get('tid') != null ?'required|numeric|exists:tags,id':'',
    	]);
    	//分类和标签都不为空
    	if(!empty($request->get('cid')) && !empty($request->get('tid')))
    	{
    		//查询
    		$questions = DB::table('questions')
    		->join('users', 'questions.user_id', '=', 'users.id')
    		->join('question_tag', 'questions.id', '=', 'question_tag.questions_id')
    		->where('question_tag.tags_id','=',$request->get('tid'))
    		->where('questions.cate_id','=',$request->get('cid'))
    		->where('questions.comments','=','')
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
    		$questionIds  = DB::table('questions')->where('cate_id','=',$request->get('cid'))->pluck('id');
    				//查询该分类下面的标签文章
    		$tags = DB::table('question_tag')
    				->join('questions', 'question_tag.questions_id', '=', 'questions.id')
    				->join('tags', 'question_tag.tags_id', '=', 'tags.id')
    				->whereIn('question_tag.questions_id', $questionIds)
    				->select('tags.id as id','tags.name as name')->get();
    		$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    		return view('wenda.question.index',['questions'=>$questions,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    	}
    	//分类不为空,标签为空
    	if(!empty($request->get('cid')))
    	{
    		$questions = DB::table('questions')
    		->join('users', 'questions.user_id', '=', 'users.id')
    		->where('questions.cate_id','=',$request->get('cid'))
    		->where('questions.comments','=','')
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
    		$questionIds  = DB::table('questions')->where('cate_id','=',$request->get('cid'))->pluck('id');
    				//查询该分类下面的标签文章
    		$tags = DB::table('question_tag')
    				->join('questions', 'question_tag.questions_id', '=', 'questions.id')
    				->join('tags', 'question_tag.tags_id', '=', 'tags.id')
    				->whereIn('question_tag.questions_id', $questionIds)
    				->select('tags.id as id','tags.name as name')->get();
    		$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    		return view('wenda.question.index',['questions'=>$questions,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    	}
    	//标签不为空,分类为空
    	if(!empty($request->get('tid')))
    	{
    		$questions = DB::table('questions')
    		->join('users', 'questions.user_id', '=', 'users.id')
    		->join('question_tag', 'questions.id', '=', 'question_tag.questions_id')
    		->where('question_tag.tags_id','=',$request->get('tid'))
    		->where('questions.comments','=','')
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
    		$questionIds  = DB::table('questions')->where('cate_id','=',$request->get('cid'))->pluck('id');
    		//查询该分类下面的标签问答
    		$tags = DB::table('question_tag')
    				->join('questions', 'question_tag.questions_id', '=', 'questions.id')
    				->join('tags', 'question_tag.tags_id', '=', 'tags.id')
    				->whereIn('question_tag.questions_id', $questionIds)
    				->select('tags.id as id','tags.name as name')->get();
    		$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    		return view('wenda.question.index',['questions'=>$questions,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    	}
    	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    	$tags = TagModel::all();
    	$questions = DB::table('questions')
    	->join('users', 'users.id', '=', 'questions.user_id')
    	->where('questions.comments','=','')
    	->select('users.id as user_id','users.name as user_name', 'questions.title as title','questions.id as question_id', 'questions.content as content','questions.created_at as created_at')
    	->orderBy('questions.created_at','desc')
    	->paginate('15');
    	return view('wenda.question.index',[
    			'questions'=>$questions,
    			'cates'=>$cates,
    			'tags'=>$tags,
    			'tid'=>'',
    			'cid'=>''
    	]);
    }
//     分类
    public function cate(Request $request)
    {
    	$this->validate($request, ['cid'=>'required|numeric|exists:category,id']);
    	$questions = DB::table('questions')
				    ->join('users', 'users.id', '=', 'questions.user_id')
				    ->where('questions.cate_id','=',$request->get('cid'))
				    ->select('users.id as user_id','users.name as user_name', 'questions.title as title','questions.id as question_id', 'questions.content as content','questions.created_at as created_at')
				    ->orderBy('questions.created_at','desc')
    				->paginate('15');
    	//查询分类
    	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    	$questionIds  = DB::table('questions')->where('cate_id','=',$request->get('cid'))->pluck('id');
    	//查询该分类下面的问答
    	$tagIds = DB::table('question_tag')
    	->join('questions', 'question_tag.questions_id', '=', 'questions.id')
    	->whereIn('question_tag.questions_id', $questionIds)
    	->select('question_tag.tags_id as tag_id')->pluck('tag_id')->toArray();
    	//去重
    	$tagIds = array_unique($tagIds);
    	
    	$tags = DB::table('tags')
    	->whereIn('tags.id', $tagIds)
    	->get();
    	return view('wenda.question.index',['questions'=>$questions,'cates'=>$cates,'tags'=>$tags,'tid'=>'','cid'=>$request->get('cid')]);
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
    		->join('users', 'questions.user_id', '=', 'users.id')
    		->join('question_tag', 'questions.id', '=', 'question_tag.questions_id')
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
    		->join('questions', 'question_tag.questions_id', '=', 'questions.id')
    		->whereIn('question_tag.questions_id', $questionIds)
    		->select('question_tag.tags_id as tag_id')->pluck('tag_id')->toArray();
    		//去重
    		$tagIds = array_unique($tagIds);
    		$tags = DB::table('tags')
    		->whereIn('tags.id', $tagIds)
    		->get();
    		//查询该分类下面的标签问答
    		$questions = DB::table('questions')
    		->join('users', 'questions.user_id', '=', 'users.id')
    		->join('question_tag', 'questions.id', '=', 'question_tag.questions_id')
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
    			'question_id'=>'required|exists:questions,id',
    			'to_user_id'=>'sometimes|exists:answers,user_id',
    			'answer_id'=>'sometimes|exists:answers,id',
    			'user_id'=>'required|exists:users,id'
    	]);
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
    
}
