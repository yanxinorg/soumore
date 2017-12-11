<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\CommentModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Common\PostModel;

class CommentController extends Controller
{
    //添加评论
    public function create(Request $request)
    {
    	$this->validate($request, [
    		'comment'=>'required|min:1',
    		'post_id'=>'required|exists:posts,id',
    		'to_user_id'=>'sometimes|exists:comments,user_id',
    		'comment_id'=>'sometimes|exists:comments,id',
    		'user_id'=>'required|exists:users,id'
    	]);
    	$result = CommentModel::create([
    		'user_id'=>$request->get('user_id'),
    		'post_id'=>$request->get('post_id'),
    		'content'=>$request->get('comment'),
    		'to_user_id'=>$request->get('to_user_id')
    	]);
    	//评论数加一
    	PostModel::where('id','=',$request->get('post_id'))->increment("comments");
    	if($result)
    	{
    		return redirect()->action('Front\PostController@detail',['id'=>$request->get('post_id')]);
    	}else{
    		return redirect()->back();
    	}
    }
}
