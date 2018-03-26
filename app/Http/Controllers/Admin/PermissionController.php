<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\UserModel;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\DB;

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
    
    //存储权限
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
    		return redirect('/back/permit/list');
    	}
    	return redirect()->back();
    	
    }
    //删除权限
    public function delete(Request $request)
    {
    	$this->validate($request, [
    		'id'=>'required|numeric|exists:permissions,id'
    	]);
    	$result = Permission::where('id','=',$request->get('id'))->delete();
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
    
    //更新权限
    public function edit(Request $request)
    {
    	$this->validate($request, [
    		'id'=>'required|numeric|exists:permissions,id'
    	]);
    	$data = Permission::where('id',$request->get('id'))->get();
    	return view('admin.permission.edit',['data'=>$data[0]]);
    }
    //保存更新
    public function update(Request $request)
    {
    	$this->validate($request, [
    		'id'=>'required|numeric|exists:permissions,id',
    		'urlname'=>'required'
    	]);
    	$result = Permission::updateOrCreate(array('id' => $request->get('id')), array('name' => $request->get('urlname'),'display_name'=>$request->get('urlalias'),'description'=>$request->get('urlremark')));
    	if($result)
    	{
    		return redirect('/back/permit/list');
    	}
    	return redirect()->back();
    }
    
}
