<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Common\CommonController;
use App\Models\Common\CategoryModel;
use App\Models\Common\DynamicModel;
use App\Models\Common\OtherTagModel;
use App\Models\Common\TagModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\PostModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //文章管理
    public function index(Request $request)
    {
        $posts = DB::table('posts')
            ->leftjoin('users', 'posts.user_id', '=', 'users.id')
            ->leftjoin('category', 'posts.cate_id', '=', 'category.id')
            ->select('users.id as user_id','users.name as author','category.name as cate_name','category.id as cate_id','posts.id as post_id','posts.publish_time as publish_time','posts.title as title','posts.thumb as thumb', 'posts.status as status','posts.created_at as created_at','posts.deleted_at as deleted_at')
            ->orderBy('posts.created_at','desc')
            ->paginate('15');
        return view('admin.post.index',['posts'=>$posts,'wd'=>$request->get('wd')?$request->get('wd'):'']);
    }

    //创建文章
    public function create()
    {
        $tags = TagModel::all();
        $cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
        $cates = CommonController::treeCreate($cates);
        return view('admin.post.create',['cates'=>$cates,'tags'=>$tags]);
    }

    //保存文章
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'cid'=>'required|numeric',
            'title'=>'required|min:2',
            'content'=>'required|min:10',
            'status'=>'required|numeric|min:0|max:1'
        ],[
            'required'=>':attribute为必填项',
            'min'=>':attribute至少 :min个字节长',
            'max'=>':attribute超出限制',
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
        //图片不为空
        if($request->file('thumb'))
        {
            $imgPath = CommonController::ImgStore($request->file('thumb'),'article');
        }else{
            $imgPath = "";
        }
        $data = [
            'user_id'  => Auth::user()->id,
            'cate_id'  => $request->get('cid'),
            'title'    => $request->get('title'),
            'thumb'   => $imgPath,
            'author'    => $request->get('author')?$request->get('author'):Auth::user()->name,
            'content'  => $request->get('content'),
            'status'   => $request->get('status'),
            'publish_time'   => $request->get('publish_time'),
        ];
        $postId = PostModel::create($data);
        //tags不为空
        if(!empty($request->get('tags')[0]))
        {
            //只取前5个标签存入
            $tmpArr = array_only($request->get('tags'), ['0','1','2','3','4']);
            foreach($tmpArr as $tag)
            {
                //话题文章总数自增一
                DB::table("tags")->where('id',$tag)->increment("posts");
                OtherTagModel::updateOrCreate([
                    'source_id'=>$postId->id,
                    'tag_id'=>$tag,
                    'source_type'=>'1'
                ],[
                    'source_id'=>$postId->id,
                    'tag_id'=>$tag,
                    'source_type'=>'1'
                ]);
            }
        }
        //用户动态表
        if($request->get('status'))
        {
            DynamicModel::updateOrCreate([
                'uid'=>Auth::user()->id,
                'source_id'=>$postId->id,
                'source_action'=>'1'
            ],[
                'uid'=>Auth::user()->id,
                'source_id'=>$postId->id,
                'source_action'=>'1',
                'subject'=>trim($request->get('title'))
            ]);
        }
        return redirect('/back/post/list');
    }

    //编辑文章
    public function edit(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:posts,id'
        ]);
        $datas = PostModel::where([ 'id'=>$request->get('id')])->get();

        //该文章选中的标签
        $selectedTags = DB::table('other_tag')
            ->leftjoin('tags', 'other_tag.tag_id', '=', 'tags.id')
            ->where('other_tag.source_id','=',$request->get('id'))
            ->where('other_tag.source_type','=','1')
            ->pluck('tags.id as id')->toArray();
        $tags = TagModel::all();
        $cates = CategoryModel::where('status','=','1')->orderBy('created_at','desc')->get();
        $cates = CommonController::treeCreate($cates);
        return view('admin.post.edit',[
            'cates'=>$cates,
            'tags'=>$tags,
            'selectedTags'=>$selectedTags,
            'datas'=>$datas[0]
        ]);
    }

    //更新文章
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id'=>'required|numeric|exists:posts,id',
            'cid'=>'required|numeric',
            'title'=>'required|min:2',
            'content'=>'required|min:10',
            'status'=>'required|numeric|min:0|max:1'
        ],[
            'required'=>':attribute为必填项',
            'min'=>':attribute至少 :min个字节长',
            'max'=>':attribute超出限制',
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

        //图片不为空
        if($request->file('thumb'))
        {
            $imgPath = CommonController::ImgStore($request->file('thumb'),'article');
        }else{
            $imgPath = DB::table('posts')->where('id',$request->get('id'))->pluck('thumb');
            $imgPath = $imgPath[0];
        }
        $data = [
            'user_id'  => Auth::user()->id,
            'cate_id'  => $request->get('cid'),
            'title'    => $request->get('title'),
            'thumb'   => $imgPath,
            'author'    => $request->get('author')?$request->get('author'):Auth::user()->name,
            'content'  => $request->get('content'),
            'status'   => $request->get('status'),
            'publish_time'   => $request->get('publish_time'),
        ];
        $postId = PostModel::updateOrCreate(array('id' => $request->get('id')), $data);
        //清除原有标签
        OtherTagModel::where(['source_id'=>$request->get('id'),'source_type'=>'1'])->delete();
        //tags不为空
        if(!empty($request->get('tags')[0]))
        {
            //只取前5个标签存入
            $tmpArr = array_only($request->get('tags'), ['0','1','2','3','4']);
            foreach($tmpArr as $tag)
            {
                //话题文章总数自增一
                DB::table("tags")->where('id',$tag)->increment("posts");
                OtherTagModel::updateOrCreate([
                    'source_id'=>$postId->id,
                    'tag_id'=>$tag,
                    'source_type'=>'1'
                ],[
                    'source_id'=>$postId->id,
                    'tag_id'=>$tag,
                    'source_type'=>'1'
                ]);
            }
        }
        return redirect('/back/post/list');
    }

    //删除文章
    public function delete(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:posts,id'
    	]);
        $result = DB::table('posts')->where('id','=',$request->get('id'))->delete();
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
    
    //更改状态
    public function status(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:posts,id'
    	]);
        if(PostModel::where(['id'=>$request->get('id'),'status'=>'1'])->update(['status'=>'0']) || PostModel::where(['id'=>$request->get('id'),'status'=>'0'])->update(['status'=>'1']))
    	{
    		$data = [
    				'code'=>'1',
    				'msg'=>'更新成功!'
    		];
    	}else{
    		$data = [
    				'code'=>'0',
    				'msg'=>'更新失败!'
    		];
    	}
    	return $data;
    	 
    }
    
}
