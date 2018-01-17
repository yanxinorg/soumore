<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\UserModel;
use App\Role;

class UserController extends Controller
{
    //用户列表
    public function index(Request $request) 
    {
    	$users = UserModel::all();
        return view('admin.user.index',['users'=>$users]);
    }
    
    //新增用户
    public function add()
    {
    	$roles = Role::all();
    	return view('admin.user.add',['roles'=>$roles]);
    }
}
