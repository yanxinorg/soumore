<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Common\UserModel;
use App\Models\Common\PostModel;
use App\Models\Common\AreaModel;
use App\Models\Front\CollectionModel;
use App\Models\Common\QuestionModel;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
	//用户信息
	protected $userinfo;
	
	public function __construct()
	{
		$this->commonData();
	}
	
	protected function commonData()
	{
		$uid = Auth::id();
		//用户信息
		if(!empty($uid))
		{
			$this->userinfo = UserModel::where('id',$uid)->get();
			$tmp = $this->userinfo[0];
		}
	}
	
	public function compose(\Illuminate\View\View $view) {
		$view->with([
				'userinfo' => $this->userinfo[0]
		]);
	}
	
}
