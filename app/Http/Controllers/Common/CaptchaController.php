<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    //验证码类
    public function captcha($tmp)
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder();
        //忽视所有干扰影响
        $builder->setIgnoreAllEffects(true);
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::flash('code', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
    
    //获取验证码
    public static function getCaptcha()
    {
    	//生成验证码图片的Builder对象，配置相应属性
    	$builder = new CaptchaBuilder();
    	//可以设置图片宽高及字体
    	$builder->build($width = 100, $height = 40, $font = null);
    	//获取验证码的内容
    	$phrase = $builder->getPhrase();
    	
    	return $phrase;
    }
    
}
