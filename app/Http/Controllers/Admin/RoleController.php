<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
	public $data = [];
    //角色首页
    public function index()
    {
    	$roles = Role::with('perms')->get(); //角色关联权限列表
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
    	if($role->save() && $request->get('permits'))
    	{
            //角色赋予权限
            $role->attachPermissions($request->get('permits'));
    	}
        return redirect('/back/role/list');
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
    			'id'=>'required|numeric|exists:roles,id'
    	]);
    	$result = Role::updateOrCreate(array('id' => $request->get('id')), array('display_name'=>$request->get('rolealias'),'description'=>$request->get('roleremark')));
    	if($result)
    	{
    		//删除之前的角色
    		DB::table('permission_role')->where('role_id',$request->get('id'))->delete();
    		//角色赋予权限
    		if(!empty($request->get('permits')))
    		{
    			foreach($request->get('permits') as $permit)
    			{
    				DB::table('permission_role')->insert(['permission_id' => $permit,'role_id' => $request->get('id')]);
    			}
    		}
    		return redirect('/back/role/list');
    	}
    	return redirect()->back();
    }
    
    
    //删除角色
    public function delete(Request $request)
    {
    	$this->validate($request, [
    		'id'=>'required|numeric|exists:roles,id'
    	]);
    	//删除角色
    	$id = $request->get('id');
    	DB::transaction(function() use($id){
    		try{
    			DB::table('roles')->where('id',$id)->delete();
    			DB::table('role_user')->where('role_id',$id)->delete();
    			DB::table('permission_role')->where('role_id',$id)->delete();
    			DB::commit();
    			$this->data = [
    					'code'=>'1',
    					'msg'=>'删除成功'
    			];
    		} catch (\Exception $e){
    			DB::rollback();
    			$this->data = [
    					'code'=>'0',
    					'msg'=>'删除失败'
    			];
    		}
    		
    	});
    	
    	return $this->data;
    }
    
    
    
}
