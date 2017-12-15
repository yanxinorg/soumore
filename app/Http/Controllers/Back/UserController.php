<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\UserModel;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Common\FileController;

class UserController extends Controller
{
    //用户列表
    public function index()
    {
    	$datas = UserModel::paginate('8');
    	return view('back.user.index',['datas'=>$datas]);
    }
    
    //新增用户
    public function create()
    {
    	return view('back.user.create');
    }
    //保存用户
    public function store(Request $request)
    {
    	$this->validate($request, [
    			'name'=>'required|unique:users,name',
    			'email'=>'required|email|unique:users,email',
    			'password'=>'required|confirmed',
    			'password_confirmation'=>'required',
    			'thumb'=>'required|mimes:jpeg,png,jpg|max:2048',
    			'status'=>'required|between:0,1',
    			'admin'=>'required|between:0,1'
    	],[
    			'required'=>':attribute不能为空',
    			'mimes'=>'图片格式错误',
    			'unique'=>':attribute已存在'
    	],[
    			'name'=>'名称',
    			'email'=>'邮箱',
    			'password'=>'密码',
    			'password_confirmation'=>'重复密码',
    			'thumb'=>'头像',
    	]);
    	//用户头像
    	$filepath = FileController::saveThumbImg($request->file('thumb'));
    	$result = UserModel::create([
    			'name'=>$request->get('name'),
    			'email'=>$request->get('email'),
    			'password'=>Hash::make($request->get('password')),
    			'avator'=>$filepath,
    			'status'=>$request->get('status'),
    			'admin'=>$request->get('admin')
    	]);
    	if($result)
    	{
    		return redirect('/back/user');
    	}
    	return redirect()->back()->withErrors([
    			'msg'=>'创建失败'
    	]);
    
    }
    
    // 删除用户
    public function delete(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:users,id'
    	]);
    	//删除该话题
    	$results = UserModel::where('id',$request->get('id'))->delete();
    	if($results)
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
    
    
}
