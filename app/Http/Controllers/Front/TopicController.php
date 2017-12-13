<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\TagModel;
use App\Models\Common\AttentionModel;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    //首页
    public function index(Request $request)
    {
    	$tags = TagModel::paginate('20');
    	return view('wenda.topic.index',['tags'=>$tags]);
    }
    
    public function hot()
    {
    	$tags = TagModel::orderBy('watchs','desc')->paginate('20');
    	return view('wenda.topic.index',['tags'=>$tags]);
    }
    
}
