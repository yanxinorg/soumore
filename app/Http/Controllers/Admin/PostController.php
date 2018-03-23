<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\PostModel;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //文章管理
    public function index()
    {
    	
    	$posts = DB::table('posts')
    	->leftjoin('users', 'posts.user_id', '=', 'users.id')
    	->select('users.name as author','users.id as user_id', 'posts.id as post_id','posts.title as title', 'posts.status as status','posts.created_at as created_at')
    	->orderBy('posts.created_at','desc')
    	->paginate('15');
    	return view('admin.post.index',['posts'=>$posts]);
    }
    
    //删除文章
    public function delete(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:posts,id'
    	]);
    	$result = PostModel::where('id','=',$request->get('id'))->delete();
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
