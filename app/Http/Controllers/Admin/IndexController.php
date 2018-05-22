<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //CMS首页
    public function index()
    {
        $os = [];
        //laravel版本
        $laravel = app();
        $os['laravel_ver'] = $laravel::VERSION;
        //数据库版本
        $os['mysql_ver'] = '';
        //服务器系统当前时间
        $os['current_time'] = time();
    	return view('admin.index.index',['os'=>$os]);
    }
}
