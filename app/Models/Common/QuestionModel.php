<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Laravel\Scout\Searchable;

class QuestionModel extends Model
{
    use Searchable;
	protected $table = 'questions';
	public $timestamps = TRUE;
	protected $fillable = ['cate_id', 'user_id','content','title'];
	
	public function getCreatedAtAttribute($date)
	{
		if (Carbon::now() < Carbon::parse($date)->addDays(10))
		{
			return Carbon::parse($date);
		}
		return Carbon::parse($date)->diffForHumans();
	}
	
}
