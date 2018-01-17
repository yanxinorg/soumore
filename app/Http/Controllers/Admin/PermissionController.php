<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\UserModel;
use App\Role;

class PermissionController extends Controller
{
    //权限列表
    public function index()
    {
    	$roles = Role::all();
    	return view('admin.permission.index',['roles'=>$roles]);
    }
    
    //新增权限
    public function add()
    {
    	return view('admin.permission.add');
    }
}
