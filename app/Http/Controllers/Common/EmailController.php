<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Jobs\RegisterEmailSend;
use App\Models\Common\CaptchaModel;
use Carbon;
use Illuminate\Support\Facades\Cache;

class EmailController extends Controller
{
	protected  $Success = TRUE;
	protected  $Msg = "";
	protected  $Data = "";
	protected  $Code = "";
	//邮件已注册
	const  Email_Exits = 201;
	//邮件格式错误
	const  Email_Format = 202;
	//邮件已发送
	const  Email_Sended = 203;
	//邮件发送频繁
	const Email_Limited = 204;
	
    //发送  "注册邮件"  验证码
    public function sendRegCaptcha(Request $request)
    {
    	$validator = Validator::make($request->all(),[
    		'email'=>'required|unique:users|email'
    	]);
    	if($validator->fails())
    	{
    		$errors = $validator->errors();
    		if(!empty($errors->first('email')))
    		{
    			$this->Success = false;
    			$this->Msg = "该邮箱已注册!";
    			$this->Code = self::Email_Exits;
    		}else{
    			$this->Success = false;
    			$this->Msg = "邮箱格式错误!";
    			$this->Code = self::Email_Format;
    		}
    	}else{
    		//限制发送次数
    		if(self::emailLimit($request->get('email')))
    		{
    			//验证码生成
    			$captcha = CaptchaController::getCaptcha();
				//存入数据库
    			$result = CaptchaModel::updateOrCreate(
    					[
	    					'email' => $request->get('email'),
	    					'type' => '1'	
    					], 
    					[
    						'email' => $request->get('email'),
    						'email_code' => $captcha,
    						'type' => '1',														//注册邮件发送
    						'valid_time'=>(\Carbon\Carbon::now()->addMinutes(3))				//验证码有效期 3分钟  
    					]);
    			if($result)
    			{
    				//发送邮件
    				dispatch(new RegisterEmailSend($request->get('email'), $captcha));
    				$this->Success = true;
    				$this->Msg = "验证码已发送注意查收!";
    				$this->Code = self::Email_Sended;
    			}
    		}else{
    			$this->Success = false;
    			$this->Msg = "邮件发送过于频繁请15分钟后再发送!";
    			$this->Code = self::Email_Limited;
    		}
    	}
    	return json_encode(['Success'=>$this->Success,'Msg'=>$this->Msg,'Code'=>$this->Code]);
    }
    
    //验证格式是否是邮箱
    public static function isEmailFormat($email)
    {
    	$preg = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
    	if(preg_match($preg, $email)){
    		return true;
    	}
    	return false;
    }
    
    //邮件发送次数限制
    public static function emailLimit($email)
    {
        $times = Cache::get($email,0);
        switch ($times)
        {
            case 0:
                Cache::put($email,1,15);
                return true;
                break;
            case 1:
                Cache::forget($email);
                Cache::put($email,2,15);
                return true;
                break;
            case 2:
                Cache::forget($email);
                Cache::put($email,3,15);
                return true;
                break;
            default:
                return false;
                break;
        }
         
    }
    
}
