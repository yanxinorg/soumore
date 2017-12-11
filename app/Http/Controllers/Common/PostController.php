<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\Common\CategoryModel;
use App\Models\Common\TagModel;
use Illuminate\Support\Facades\DB;
use App\Models\Common\NoticeModel;

class PostController extends Controller
{
	protected $cates;
	protected $tags;
	protected $hots;
	protected $notice;
	
	public function __construct()
	{
		$this->commonData();
	}
	
	protected function commonData()
	{
		//分类
		$this->cates = CategoryModel::all();
		//标签
		$this->tags = TagModel::all();
		//推荐文章
		$this->hots = DB::table('posts')->orderBy('supports','desc')->limit('10')->get();
		//公告内容
		$this->notice = NoticeModel::orderBy('created_at','desc')->first();
	}
	
	public function compose(\Illuminate\View\View $view) {
		$view->with([
				'cates' => $this->cates,
				'tags' => $this->tags,
				'hots' => $this->hots,
				'notice' =>$this->notice
		]);
	}
}
