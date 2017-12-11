<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class VisitorModel extends Model
{
    //访问用户表
	protected $table = 'visitors';
	public $timestamps = TRUE;
	protected $fillable = ['user_id','visitor_id', 'created_at','updated_at','visitor_time'];

	public function getVisitorTimeAttribute($date)
	{    
		if (Carbon\Carbon::now() < Carbon::parse($date)->addDays(10)) 
			{
				return Carbon::parse($date);
			}    
		return Carbon::parse($date)->diffForHumans();
	}
	

}
