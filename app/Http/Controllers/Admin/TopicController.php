<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\TagModel;
use App\Models\Common\CategoryModel;

class TopicController extends Controller
{
    //话题列表
    public function index() 
    {
        $tags = TagModel::all();
        return view('admin.topic.index',['tags'=>$tags]);
    }
    
    //新增话题
    public function add() 
    {
        $cates = CategoryModel::all();
        return view('admin.topic.add',['cates'=>$cates]);
    }
}
