<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SpecialCharacterController extends Controller
{
    //检测非法字符 或者弱口令
    
	public static function isUserLegal($user)
	{
		$result = DB::table('special_character')->where('username',$user)->get();
		if(empty($result[0]))
		{
			//不非法 及 合法 用户名
			return false;
		}else{
			return true;
		}
	}
}
