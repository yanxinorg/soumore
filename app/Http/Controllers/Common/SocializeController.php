<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocializeController extends Controller
{
	//qq授权
	public function qqAuth()
	{
		return Socialite::with('qq')->redirect();
	}
  
	//qq回调
    public function qqCallback()
    {
    	$user = Socialite::driver('qq')->user();
    	dd($user);
    }
    
    
    //微博授权
    public function weiboAuth()
    {
    	return \Socialite::with('weibo')->redirect();
    	// return \Socialite::with('weibo')->scopes(array('email'))->redirect();
    }
    
    //微博回调
    public function weiboCallback()
    {
    	$oauthUser = Socialite::with('weibo')->user();
    	var_dump($oauthUser->getId());
    	var_dump($oauthUser->getNickname());
    	var_dump($oauthUser->getName());
    	var_dump($oauthUser->getEmail());
    	var_dump($oauthUser->getAvatar());
    	 
    }
  
    //微信授权
    public function weixinAuth()
    {
    	return Socialite::with('weixin')->redirect();
    	// return \Socialite::with('weibo')->scopes(array('email'))->redirect();
    }
    
    //微信回调
    public function weixinCallback()
    {
    	$user_data = Socialite::with('weixin')->user();
    	//todo whatever
    }
  
}
