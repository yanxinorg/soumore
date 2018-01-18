<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\CategoryModel;
use App\Http\Controllers\Common\CommonController;

class CateController extends Controller
{
    //分类列表
    public function index()
    {
    	$cates = CategoryModel::all();
    	$cates = CommonController::treeCreate($cates);
    	return view('admin.cate.index',['cates'=>$cates]);
    }
    
    //新增分类
    public function add()
    {
        $cates = CategoryModel::all();
    	return view('admin.cate.add',['cates'=>$cates]);
    }
    
    //保存新增分类
    public function store(Request $request)
    {
    	
    }
}
