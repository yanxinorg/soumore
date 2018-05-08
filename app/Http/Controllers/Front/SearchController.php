<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Common\PostModel;
use App\Models\Common\TagModel;
use App\Models\Common\QuestionModel;
use App\Models\Common\UserModel;

class SearchController extends Controller
{
    protected $wd;
    public function __construct(Request $request) 
    {
        $this->wd = $request->get('wd');
        view()->composer('layouts/ask', function ($view) {
        	$view->with('wd',$this->wd);
        });
    }
    //默认是文章
    public function index(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    			'wd' =>'required|min:1|max:128',
    	]);
    	if ($validator->fails())
    	{
    		return redirect()->back();
    	}
    	//文章个数
        $result = PostModel::search($request->get('wd'))->get();
        $postCount = count($result);
        //问答个数
        $result = QuestionModel::search($request->get('wd'))->get();
        $questionCount = count($result);
        //问答个数
        $result = TagModel::search($request->get('wd'))->get();
        $tagCount = count($result);
        //用户个数
        $result = UserModel::search($request->get('wd'))->get();
        $userCount = count($result);
    	return view('ask.search.index',['postCount'=>$postCount,'questionCount'=>$questionCount,'tagCount'=>$tagCount,'userCount'=>$userCount,'wd'=>$this->wd]);
    }
    
    //文章搜索
    public function post(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    			'wd' =>'required|min:1|max:128',
    	]);
    	if ($validator->fails())
    	{
    		return redirect()->back();
    	}
    	$datas = PostModel::search($request->get('wd'))->paginate(10);
    	return view('ask.search.post',['datas'=>$datas,'wd'=>$request->get('wd')]);
    	 
    }
    
    //问答搜索
    public function wenda(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    			'wd' =>'required|min:1|max:128',
    	]);
    	if ($validator->fails())
    	{
    		return redirect()->back();
    	}
    	$datas = QuestionModel::search($request->get('wd'))->paginate(10);
    	return view('ask.search.question',['datas'=>$datas,'wd'=>$request->get('wd')]);
    	
    }
    
    //话题搜索
    public function topic(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    			'wd' =>'required|min:1|max:128',
    	]);
    	if ($validator->fails())
    	{
    		return redirect()->back();
    	}
    	$datas = TagModel::search($request->get('wd'))->paginate(10);
    	return view('ask.search.topic',['datas'=>$datas,'wd'=>$request->get('wd')]);
    
    }
    
    
    //用户搜索
    public function user(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    			'wd' =>'required|min:1|max:128',
    	]);
    	if ($validator->fails())
    	{
    		return redirect()->back();
    	}
    	$datas = UserModel::search($request->get('wd'))->paginate(10);
    	return view('ask.search.user',['datas'=>$datas,'wd'=>$request->get('wd')]);
    }
}
