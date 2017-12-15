<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\UserModel;

class UserController extends Controller
{
    //用户列表
    public function index()
    {
    	$datas = UserModel::paginate('2');
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
    			'thumb'=>'required|mimes:jpeg,png,jpg',
    			'status'=>'required|numeric'
    	],[
    			'required'=>':attribute不能为空',
    			'mimes'=>'图片格式错误',
    			'unique'=>':attribute已存在'
    	],[
    			'name'=>'名称',
    			'email'=>'邮箱',
    			'password'=>'密码',
    			'thumb'=>'头像',
    	]);
    	$file = $request->file('thumb');
    		
    	$extention = $file->getClientOriginalExtension();
    	//话题缩略图
    	$filepath = FileController::saveCateImg($file,'topic');
    
    	$result = TagModel::create([
    			'name'=>$request->get('name'),
    			'thumb'=>$filepath,
    			'mime'=>$file->getClientMimeType(),
    			'desc'=>$request->get('desc'),
    			'status'=>$request->get('status')
    	]);
    	if($result)
    	{
    		return redirect('/back/tag');
    	}
    	return redirect()->back()->withErrors([
    			'msg'=>'创建失败'
    	]);
    
    }
    
}
