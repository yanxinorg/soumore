<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\PostModel;
use Illuminate\Support\Facades\DB;
use App\Models\Common\CategoryModel;
use App\Models\Common\TagModel;
use Hamcrest\Type\IsString;

class CategoryController extends Controller
{
    //筛选列表
    public function index(Request $request)
    {
    	$cates = CategoryModel::all();
    	if($request->get('cateid') !== "0")
    	{
    		$this->validate($request, [
    				'cateid'=>'required|numeric|exists:category,id'
    		]);
			$cateId = $request->get('cateid');
    	}else{
    		//默认分类
    		$cateId = "0";
    	}
    	
    	return view('wenda.cate.index',['cateid'=>$cateId,'cates'=>$cates]);
    }
    
    //文章分类筛选
    public function article(Request $request)
    {
    	$cates = CategoryModel::all();
    	$datas = PostModel::cateArticle("1",$request->get('cateid'));
    	return view('wenda.cate.article',['datas'=>$datas,'cateid'=>$request->get('cateid'),'cates'=>$cates]);
    }
    
    //问答分类刷选
    public function answer(Request $request)
    {
    	$cates = CategoryModel::all();
    	$questions = DB::table('questions')
    	->join('users', 'users.id', '=', 'questions.user_id')
    	->where('questions.cate_id','=',$request->get('cateid'))
    	->select('users.id as user_id','users.name as user_name', 'questions.title as title','questions.id as question_id', 'questions.content as content','questions.created_at as created_at')
    	->paginate('5');
    	return view('wenda.cate.answer',[
    			'questions'=>$questions,
    			'cateid'=>$request->get('cateid'),
    			'cates'=>$cates
    	]);
    }
}
