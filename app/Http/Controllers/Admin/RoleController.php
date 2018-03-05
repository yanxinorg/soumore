<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\UserModel;
use App\Role;
use App\Permission;

class RoleController extends Controller
{
    //角色首页
    public function index()
    {
    	$roles = Role::all();
    	return view('admin.role.index',['roles'=>$roles]);
    }
    
    //新增角色
    public function add()
    {
    	//获取权限列表
    	$permits = Permission::all();
    	return view('admin.role.add',['permits'=>$permits]);
    }
    
    
}
