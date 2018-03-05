<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\UserModel;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //角色首页
    public function index()
    {
    	$roles = Role::all();
    	$total = DB::table('roles')->sum('id');
    	return view('admin.role.index',['roles'=>$roles,'total'=>$total]);
    }
    
    //新增角色
    public function add()
    {
    	//获取权限列表
    	$permits = Permission::all();
    	return view('admin.role.add',['permits'=>$permits]);
    }
    
    //角色存储
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'rolename'=>'required|unique:roles,name'
    	]);
    	$role = new Role();
    	$role->name = $request->get('rolename');
    	$role->display_name = $request->get('rolealias');
    	$role->description = $request->get('roleremark');
    	if($role->save())
    	{
    		//角色赋予权限
    		$role->attachPermissions($request->get('permits'));
    		return redirect('/role/list');
    	}
    	return redirect()->back();
    }
    
    //编辑角色
    public function edit(Request $request)
    {
    	$this->validate($request, [
    		'id'=>'required|numeric|exists:roles,id'
    	]);
    	$data = Role::where('id',$request->get('id'))->get();
    	$pertIds = DB::table('permission_role')->where('role_id',$request->get('id'))->pluck('permission_id')->toArray();
    	//该角色没有的权限
    	$froms = DB::table('permissions')->whereNotIn('id',$pertIds)->get();
    	
    	//该角色已经拥有的权限
    	$tos = DB::table('permissions')->whereIn('id', $pertIds)->get();
    	
    	return view('admin.role.edit',['data'=>$data[0],'froms'=>$froms,'tos'=>$tos]);
    }
    
    //保存更新
    public function update(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:roles,id',
    			'rolename'=>'required'
    	]);
    	$result = Role::updateOrCreate(array('id' => $request->get('id')), array('name' => $request->get('rolename'),'display_name'=>$request->get('rolealias'),'description'=>$request->get('roleremark')));
    	if($result)
    	{
    		//删除之前的角色
    		DB::table('permission_role')->where('role_id',$request->get('id'))->delete();
    		//角色赋予权限
    		if(!empty($request->get('permits')))
    		{
    			foreach($request->get('permits') as $permit)
    			{
    				DB::table('permission_role')->insert(['permission_id' => $permit, 'role_id' => $request->get('id')]);
    			}
    		}
    		return redirect('/role/list');
    	}
    	return redirect()->back();
    }
}
