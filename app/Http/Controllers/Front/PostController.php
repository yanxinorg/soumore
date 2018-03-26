<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\CategoryModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Common\PostModel;
use App\Models\Common\TagModel;
use App\Models\Common\PostTagModel;
use App\Http\Controllers\Common\FileController;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Validator;
use App\Models\Front\CollectionModel;

class PostController extends Controller
{
	
    //文章列表
    public function index()
    {
		//文章
      	$datas = PostModel::lists();
      	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
      	$tags = TagModel::all();
        return view('wenda.post.index',['datas'=>$datas,'cates'=>$cates,'tags'=>$tags,'cid'=>'','tid'=>'']);
    }
    
    //我收藏的文章列表
    public function myCollect(Request $request)
    {
    	$this->validate($request, [
    			'cid'=>$request->get('cid') != null ?'required|numeric|exists:category,id':'',
    			'tid'=>$request->get('tid') != null ?'required|numeric|exists:tags,id':'',
    	]);
    	//分类和标签都不为空
    	if(!empty($request->get('cid')) && !empty($request->get('tid')))
    	{
    		//查询
    		$datas = DB::table('posts')
    		->leftjoin('users', 'posts.user_id', '=', 'users.id')
    		->leftjoin('post_tag', 'posts.id', '=', 'post_tag.posts_id')
    		->leftjoin('collections', 'posts.id', '=', 'collections.source_id')
    		->where('collections.user_id','=',Auth::id())
    		->where('collections.source_type','=','1')
    		->where('post_tag.tags_id','=',$request->get('tid'))
    		->where('posts.cate_id','=',$request->get('cid'))
    		->where('posts.status','=','1')
    		->select('posts.id as post_id',
    				'posts.title as title',
    				'users.name as author',
    				'posts.user_id as user_id',
    				'posts.excerpt as excerpt',
    				'posts.content as content',
    				'posts.thumb as thumb',
    				'posts.created_at as created_at',
    				'posts.comments as comments')
    				->orderBy('posts.created_at','desc')
    				->paginate('15');
    
    		$postIds  = DB::table('posts')->where('cate_id','=',$request->get('cid'))->pluck('id');
    		//查询该分类下面的标签文章
    		$tagIds = DB::table('post_tag')
    		->leftjoin('posts', 'post_tag.posts_id', '=', 'posts.id')
    		->whereIn('post_tag.posts_id', $postIds)
    		->select('post_tag.tags_id as tag_id')->pluck('tag_id')->toArray();
    		//去重
    		$tagIds = array_unique($tagIds);
    		$tags = DB::table('tags')
    		->whereIn('tags.id', $tagIds)
    		->get();
    		$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    		return view('wenda.post.index',['datas'=>$datas,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    	}
    	//分类不为空,标签为空
    	if(!empty($request->get('cid')))
    	{
    		$datas = DB::table('collections')
    		->leftjoin('users', 'collections.user_id', '=', 'users.id')
    		->leftjoin('posts', 'collections.source_id', '=', 'posts.id')
    		->where('collections.user_id','=',Auth::id())
    		->where('collections.source_type','=',$request->get('source_type','1'))
    		->where('posts.cate_id','=',$request->get('cid'))
    		->select('posts.id as post_id',
    				'posts.title as title',
    				'users.name as author',
    				'posts.user_id as user_id',
    				'posts.cate_id as cateid',
    				'posts.excerpt as excerpt',
    				'posts.content as content',
    				'posts.thumb as thumb',
    				'posts.created_at as created_at',
    				'posts.comments as countcomment')
    				->orderBy('posts.created_at','desc')->paginate('15');
    		$postIds  = DB::table('posts')->where('cate_id','=',$request->get('cid'))->pluck('id');
    		//查询该分类下面的标签文章
    		$tagIds = DB::table('post_tag')
    		->leftjoin('posts', 'post_tag.posts_id', '=', 'posts.id')
    		->whereIn('post_tag.posts_id', $postIds)
    		->select('post_tag.tags_id as tag_id')->pluck('tag_id')->toArray();
    		//去重
    		$tagIds = array_unique($tagIds);
    		$tags = DB::table('tags')
    		->whereIn('tags.id', $tagIds)
    		->get();
    		$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    		return view('wenda.post.index',['datas'=>$datas,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    	}
    	//标签不为空,分类为空
    	if(!empty($request->get('tid')))
    	{
    		$datas = DB::table('collections')
    		->leftjoin('users', 'collections.user_id', '=', 'users.id')
    		->leftjoin('posts', 'collections.source_id', '=', 'posts.id')
    		->where('collections.user_id','=',Auth::id())
    		->where('collections.source_type','=',$request->get('source_type','1'))
    		->where('posts.cate_id','=',$request->get('cid'))
    		->select('posts.id as post_id',
    				'posts.title as title',
    				'users.name as author',
    				'posts.user_id as user_id',
    				'posts.cate_id as cateid',
    				'posts.excerpt as excerpt',
    				'posts.content as content',
    				'posts.thumb as thumb',
    				'posts.created_at as created_at',
    				'posts.comments as countcomment')
    				->orderBy('posts.created_at','desc')->paginate('15');
    				$postIds  = DB::table('posts')->where('cate_id','=',$request->get('cid'))->pluck('id');
    				//查询该分类下面的标签文章
    				$tagIds = DB::table('post_tag')
    				->leftjoin('posts', 'post_tag.posts_id', '=', 'posts.id')
    				->whereIn('post_tag.posts_id', $postIds)
    				->select('post_tag.tags_id as tag_id')->pluck('tag_id')->toArray();
    				//去重
    				$tagIds = array_unique($tagIds);
    				$tags = DB::table('tags')
    				->whereIn('tags.id', $tagIds)
    				->get();
    				$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    				return view('wenda.post.index',['datas'=>$datas,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    	}
    	//分类标签都为空
    	$datas = DB::table('collections')
    		->leftjoin('users', 'collections.user_id', '=', 'users.id')
    		->leftjoin('posts', 'collections.source_id', '=', 'posts.id')
    		->where('collections.user_id','=',Auth::id())
    		->where('collections.source_type','=',$request->get('source_type','1'))
    		->select('posts.id as post_id',
    				'posts.title as title',
    				'users.name as author',
    				'posts.user_id as user_id',
    				'posts.cate_id as cateid',
    				'posts.excerpt as excerpt',
    				'posts.content as content',
    				'posts.thumb as thumb',
    				'posts.created_at as created_at',
    				'posts.comments as countcomment')
    				->orderBy('posts.created_at','desc')->paginate('15');
    	$tags = TagModel::all();
    	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    	return view('wenda.post.index',['datas'=>$datas,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    }
    
    //文章新增
    public function create() 
    {
    	$tags = TagModel::all();
    	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
        return view('wenda.post.create',[
        	'cates'=>$cates,
        	'tags'=>$tags
        ]);
    }
    //保存文章
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(),[
    		'cid'=>'required|numeric|exists:category,id',
    		'title'=>'required|min:2',
    		'content'=>'required|min:10',
    		'status'=>'required|numeric|min:0|max:1'
    	],[
    		'required'=>':attribute为必填项',
    		'min'=>':attribute至少 :min个字节长',
    		'max'=>':attribute超出限制',
    		'mimes'=>'图片格式错误'
    	],[
    		'cid'=>'分类',
    		'title'=>'标题',
    		'content'=>'内容',
    		'status'=>'状态',
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
    			'status'   => $request->get('status'),
    	];
    	//图片上传
    	if(!empty($request->file('cover')))
    	{
    	    $file = $request->file('cover');
    	    
    	    $file = $file[0];
    	    
    	    $extention = $file->getClientOriginalExtension();
    	    
    	    $data['mime'] = $file->getClientMimeType();
    	    //存储原始图片
    		$thumb = FileController::savePostImg($file);
    		
    		//图片原始尺寸
    		$orgheight = Image::make(storage_path().'/app/'.$thumb)->height();
    		
    		//图片原始宽度
    		$orgwidth = Image::make(storage_path().'/app/'.$thumb)->width();
    		
    		//开始压缩图片
    		$img = Image::make(storage_path().'/app/'.$thumb);
    		
    		$orgwidth >= $orgheight?$img->resize(168, 168*($orgheight/$orgwidth)):$img->resize(168*($orgwidth/$orgheight), 168);
    	
    		$fileName = uniqid(str_random(10)).'.'.$extention;
    		 
    		$smallfilepath = 'article/'.gmdate("Y")."/".gmdate("m")."/".$fileName;
    		 
    		$img->save(storage_path().'/app/'.$smallfilepath);
    		
    		$data['thumb'] = $thumb;
    		
    		$data['thumb_small'] = $smallfilepath;
    	}
    	$postId = PostModel::create($data);
    	//tags不为空
    	if(!empty($request->get('tags')[0]))
    	{
    		//只取前5个标签存入
    		$tmpArr = array_only($request->get('tags'), ['0','1','2','3','4']);
    		
    		foreach($tmpArr as $tag)
    		{
    			PostTagModel::updateOrCreate([
    					'posts_id'=>$postId->id,
    					'tags_id'=>$tag
    			],[
    					'posts_id'=>$postId->id,
    					'tags_id'=>$tag
    			]);
    		}
    	
    	}
    	return redirect('/post');
    }
    //文章编辑
    public function edit(Request $request)
    {
    	$this->validate($request, [
    		'id'=>'required|numeric|exists:posts,id'
    	]);
    	$datas =PostModel::where([
    		'id'=>$request->get('id'),
    		'user_id'=>Auth::id()
    	])->get();
    	
    	//该文章选中的标签
    	$selectedTags = DB::table('post_tag')
    	->leftjoin('tags', 'post_tag.tags_id', '=', 'tags.id')
    	->where('post_tag.posts_id','=',$request->get('id'))
    	->select('tags.name as name','tags.id as id')->orderBy('tags.created_at','desc')->get();
    	$tmp = [];
    	foreach ($selectedTags as $k=>$v)
    	{
    		$tmp[$k] = $v->id;
    	}
    	$c[] = implode(",",$tmp);
    	//除去选中的tags
    	$tags = DB::table('tags')
    	->whereNotIn('id', $c)->get();
    	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    	return view('wenda.post.edit',[
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
    			'id'=>'required|numeric|exists:posts,id',
    			'cid'=>'required|numeric|exists:category,id',
    			'title'=>'required|min:2',
    			'content'=>'required|min:10',
    			'tags.*'=>'sometimes|max:18',
    			'status'=>'required|numeric|min:0|max:1'
    	],[
    			'required'=>':attribute为必填项',
    			'min'=>':attribute至少 :min个字节长',
    			'max'=>':attribute超出限制',
    			'mimes'=>'图片格式错误'
    	],[
    			'cid'=>'分类',
    			'title'=>'标题',
    			'cover'=>'图片',
    			'content'=>'内容',
    			'tags.*'=>'标签',
    			'status'=>'状态',
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
    			'status'   => $request->get('status'),
    	];
    	//图片上传
    	if($request->hasFile('cover'))
    	{
    		$file = $request->file('cover');
    			
    		$file = $file[0];
    		
    		$extention = $file->getClientOriginalExtension();
    			
    		$data['mime'] = $file->getClientMimeType();
    		//存储原始图片
    		$thumb = FileController::savePostImg($file);
    	
    		//图片原始尺寸
    		$orgheight = Image::make(storage_path().'/app/'.$thumb)->height();
    	
    		//图片原始宽度
    		$orgwidth = Image::make(storage_path().'/app/'.$thumb)->width();
    	
    		//开始压缩图片
    		$img = Image::make(storage_path().'/app/'.$thumb);
    	
    		if($orgwidth >= $orgheight)
    		{
    			//压缩
    			$img->resize(168, 168*($orgheight/$orgwidth));
    		}else{
    			//压缩
    			$img->resize(168*($orgwidth/$orgheight), 168);
    		}
    		 
    		$fileName = uniqid(str_random(10)).'.'.$extention;
    		 
    		$smallfilepath = 'article/'.gmdate("Y")."/".gmdate("m")."/".$fileName;
    		 
    		$img->save(storage_path().'/app/'.$smallfilepath);
    	
    		$data['thumb'] = $thumb;
    	
    		$data['thumb_small'] = $smallfilepath;
    	}
    	//更新
    	$postId = PostModel::updateOrCreate(array('id' => $request->get('id')), $data);
    	//清除原有标签
    	PostTagModel::where(['posts_id'=>$request->get('id')])->delete();
    	//新增标签
    	if(!empty($request->get('tags')[0]))
    	{
    			//只取前5个标签存入
    			$tmpArr = array_only($request->get('tags'), ['0','1','2','3','4']);
    		
    			foreach($tmpArr as $tag)
    			{
    				PostTagModel::updateOrCreate([
    						'posts_id'=>$postId->id,
    						'tags_id'=>$tag
    				],[
    						'posts_id'=>$postId->id,
    						'tags_id'=>$tag
    				]);
    			}
    	}
    	return redirect('/person/post');
    }
    
	//文章详情
    public function detail(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:posts,id'
        ]);
        
        //查询文章
        $datas = DB::table('posts')
        ->leftjoin('users', 'posts.user_id', '=', 'users.id')
        ->leftjoin('category', 'posts.cate_id', '=', 'category.id')
        ->where('posts.id','=',$request->get('id'))
        ->select('posts.id as post_id',
            'posts.title as title', 
            'users.name as author', 
        	'posts.user_id as user_id',
        	'category.name as catename',
        	'posts.cate_id as cateid',
            'posts.excerpt as excerpt', 
            'posts.content as content',
            'posts.thumb as thumb',
            'posts.created_at as created_at',
            'posts.comments as countcomment'
            )->orderBy('posts.created_at','desc')->get();
        //标签
        $tagss = DB::table('post_tag')
        ->leftjoin('tags', 'post_tag.tags_id', '=', 'tags.id')
        ->where('post_tag.posts_id','=',$request->get('id'))
        ->select(
        		'tags.name as name',
            	'tags.id as id'
        		)
        ->orderBy('tags.created_at','desc')
        ->paginate('10');
        //评论内容
        $comments = DB::table('comments')
        ->leftjoin('users', 'comments.user_id', '=', 'users.id')
        ->where('comments.post_id','=',$request->get('id'))
        ->where('comments.status','=','1')
        ->select('comments.id as comment_id',
            'comments.user_id as user_id', 
        	'comments.post_id as post_id',
            'comments.content as content', 
            'comments.to_user_id as to_user_id',
            'comments.created_at as created_at',
            'comments.status as status',
        	'users.name as commentator',
        	'users.avator as avator')
        ->orderBy('comments.created_at','asc')
        ->paginate('15');
        
        //是否收藏
        if(!empty(Auth::id()))
        {
        	if(CollectionModel::where(['user_id'=>Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'1'])->exists())
        	{
        		$isCollected = true;
        	}else{
        		$isCollected = false;
        	}
        }else{
        	$isCollected = false;
        }
        return view('wenda.post.detail',['datas'=>$datas[0],'tagss'=>$tagss,'comments'=>$comments,'id'=>$request->get('id'),'isCollected'=>$isCollected]);
    }
		    
    //文章分类筛选列表
    public function cate(Request $request)
    {
    	$this->validate($request, ['cid'=>'required|numeric|exists:category,id']);
    	$datas = DB::table('posts')
    	->leftjoin('users', 'posts.user_id', '=', 'users.id')
    	->where('posts.status','=','1')
    	->where('posts.cate_id','=',$request->get('cid'))
    	->select('posts.id as post_id',
    			'posts.title as title',
    			'users.name as author',
    			'posts.user_id as user_id',
    			'posts.excerpt as excerpt',
    			'posts.content as content',
    			'posts.thumb as thumb',
    			'posts.created_at as created_at',
    			'posts.comments as comments')
    	->orderBy('posts.created_at','desc')
    	->paginate('15');
		//查询分类
    	$cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
    	$postIds  = DB::table('posts')->where('cate_id','=',$request->get('cid'))->pluck('id');
    	//查询该分类下面的标签文章
    	$tagIds = DB::table('post_tag')
    	->leftjoin('posts', 'post_tag.posts_id', '=', 'posts.id')
    	->whereIn('post_tag.posts_id', $postIds)
    	->select('post_tag.tags_id as tag_id')->pluck('tag_id')->toArray();
    	//去重
    	$tagIds = array_unique($tagIds);
    	$tags = DB::table('tags')
    	->whereIn('tags.id', $tagIds)
    	->get();
    	return view('wenda.post.index',['datas'=>$datas,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    }
    
    //文章标签筛选列表
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
    		$datas = DB::table('posts')
    		->leftjoin('users', 'posts.user_id', '=', 'users.id')
    		->leftjoin('post_tag', 'posts.id', '=', 'post_tag.posts_id')
    		->where('post_tag.tags_id','=',$request->get('tid'))
    		->where('posts.status','=','1')
    		->select('posts.id as post_id',
    				'posts.title as title',
    				'users.name as author',
    				'posts.user_id as user_id',
    				'posts.excerpt as excerpt',
    				'posts.content as content',
    				'posts.thumb as thumb',
    				'posts.created_at as created_at',
    				'posts.comments as comments')
    				->orderBy('posts.created_at','desc')
    				->paginate('15');
    		$tags = TagModel::all();	 
    	}else{
    		$postIds  = DB::table('posts')->where('cate_id','=',$request->get('cid'))->pluck('id');
    		//查询该分类下面的标签文章
    		$tagIds = DB::table('post_tag')
    		->leftjoin('posts', 'post_tag.posts_id', '=', 'posts.id')
    		->whereIn('post_tag.posts_id', $postIds)
    		->select('post_tag.tags_id as tag_id')->pluck('tag_id')->toArray();
    		//去重
    		$tagIds = array_unique($tagIds);
    		$tags = DB::table('tags')
    		->whereIn('tags.id', $tagIds)
    		->get();
    		//查询该分类下面的标签文章
    		$datas = DB::table('posts')
    		->leftjoin('users', 'posts.user_id', '=', 'users.id')
    		->leftjoin('post_tag', 'posts.id', '=', 'post_tag.posts_id')
    		->where('posts.status','=','1')
    		->where('post_tag.tags_id','=',$request->get('tid'))
    		->where('posts.cate_id','=',$request->get('cid'))
    		->select('posts.id as post_id',
    				'posts.title as title',
    				'users.name as author',
    				'posts.user_id as user_id',
    				'posts.excerpt as excerpt',
    				'posts.content as content',
    				'posts.thumb as thumb',
    				'posts.created_at as created_at',
    				'posts.comments as comments')
    				->orderBy('posts.created_at','desc')
    				->paginate('15');
    		}
    	return view('wenda.post.index',['datas'=>$datas,'cid'=>$request->get('cid'),'tid'=>$request->get('tid'),'cates'=>$cates,'tags'=>$tags]);
    }
    
    //文章删除
    public function del(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:posts,id'
    	]);
    	$result = DB::table('posts')->where([
    			'id'=>$request->get('id'),
    			'user_id'=>Auth::id()
    	])->delete();
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
    
    //文章收藏
    public function collect(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:posts,id'
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
    	if(!CollectionModel::where(['user_id' => Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'1'])->exists())
    	{
    		CollectionModel::updateOrCreate(
    				array('user_id' => Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'1'),
    				array('user_id' => Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'1')
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
    			'id'=>'required|numeric|exists:posts,id'
    	]);
    	CollectionModel::where(['user_id' => Auth::id(),'source_id'=>$request->get('id'),'source_type'=>'1'])->delete();
    	$data = [
    			'code'=>'1',
    			'msg'=>'取消收藏'
    	];
    	return $data;
    }
}

