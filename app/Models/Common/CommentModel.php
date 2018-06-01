<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class CommentModel extends Model
{
    //
	protected $table = 'comments';
	public $timestamps = TRUE;
	protected $fillable = ['user_id','source_id','source_type','to_user_id','content','status','created_at','updated_at'];
	
	public function getCreatedAtAttribute($date)
	{
		if (Carbon\Carbon::now() < Carbon::parse($date)->addDays(10))
		{
			return Carbon\Carbon::parse($date);
		}
		return Carbon::parse($date)->diffForHumans();
	}
	
}
