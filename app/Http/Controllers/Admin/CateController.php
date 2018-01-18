<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\CategoryModel;

class CateController extends Controller
{
    //分类列表
    public function index()
    {
    	$cates = CategoryModel::all();
    	return view('admin.cate.index',['cates'=>$cates]);
    }
    
    //新增分类
    public function add()
    {
    	return view('admin.cate.add');
    }
    
    //保存新增分类
    public function store(Request $request)
    {
    	
    }
}
