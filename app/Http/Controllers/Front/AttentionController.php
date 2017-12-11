<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\AttentionModel;
use Illuminate\Support\Facades\Auth;

class AttentionController extends Controller
{
    //关注人物
    public function user(Request $request)
    {
    	$this->validate($request, ['uid'=>'required|exists:users,id']);
    	//新增关注
    	$result = AttentionModel::updateOrCreate([
    		'user_id'=>Auth::id(),
    		'source_id'=>$request->get('uid'),
    		'source_type'=>'1'
    	],[
    		'user_id'=>Auth::id(),
    		'source_id'=>$request->get('uid'),
    		'source_type'=>'1'
    	]);
    	if(!empty($result['user_id']))
    	{
    		//保存成功
    		return redirect()->back();
    	}
    }
    
    public function cancelUser(Request $request)
    {
    	$this->validate($request, ['uid'=>'required|exists:users,id']);
    	//取消关注
    	$result = AttentionModel::where([
    		'user_id'=>Auth::id(),
    		'source_id'=>$request->get('uid'),
    		'source_type'=>'1'
    	])->delete();
    	if($result)
    	{
    		//保存成功
    		return redirect()->back();
    	}
    }
    
}
