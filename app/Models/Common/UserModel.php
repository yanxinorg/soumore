<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class UserModel extends Model
{
	protected $table = 'users';
	public $timestamps = TRUE;
	protected $fillable = ['uid','name', 'email','password','avator','latest_login_time','latest_login_ip','latest_logout_time'];
	
}
