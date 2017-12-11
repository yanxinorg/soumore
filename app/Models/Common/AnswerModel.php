<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class AnswerModel extends Model
{
    //
	protected $table = 'answers';
	protected $fillable = ['user_id','question_id','to_user_id','content','status','created_at','updated_at'];
	
	public function getCreatedAtAttribute($date)
	{
		if (Carbon\Carbon::now() < Carbon::parse($date)->addDays(10))
		{
			return Carbon\Carbon::parse($date);
		}
		return Carbon::parse($date)->diffForHumans();
	}
	
}
