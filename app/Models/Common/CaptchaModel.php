<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class CaptchaModel extends Model
{
    //验证码
	protected $table = 'captchas';
	public $timestamps = TRUE;
	protected $fillable = ['mobile', 'email','mobile_code','email_code','valid_time','type'];
}
