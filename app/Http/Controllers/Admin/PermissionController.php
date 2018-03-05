<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\UserModel;
use App\Role;
use App\Permission;

class PermissionController extends Controller
{
    //权限列表
    public function index()
    {
    	$permits = Permission::orderBy('created_at','desc')->get();
    	return view('admin.permission.index',['permits'=>$permits]);
    }
    
    //新增权限
    public function add()
    {
    	return view('admin.permission.add');
    }
    
    //存储编辑文章
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'urlname'=>'required|unique:permissions,name'
    	]);
    	$permt = new Permission();
    	$permt->name = $request->get('urlname');
    	$permt->display_name = $request->get('urlalias');
    	$permt->description = $request->get('urlremark');
    	if($permt->save())
    	{
    		return redirect('/permit/list');
    	}
    	return redirect()->back();
    	
    }
}
