<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    //权限管理
    public function index(Request $request)
    {
    	return view('back.permission.index');
    }
    
    //新增权限
    public function create()
    {
    	return view('back.permission.create');
    }
}
