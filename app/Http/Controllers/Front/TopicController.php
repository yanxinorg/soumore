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
    
    //筛选
    public function abc(Request $request)
    {
    	$this->validate($request, [
    		'val'=>'required|alpha'
    	]);
    	$abc = $request->get('val');
    	$ABC = strtoupper($abc);
    	$datas = DB::table('tags')
		    	->where('en_name', 'like', $abc.'%')
		    	->orWhere('en_name', 'like', $ABC.'%')
		    	->paginate('15');
		return view('wenda.topic.index',['tags'=>$datas]);
    }
}
