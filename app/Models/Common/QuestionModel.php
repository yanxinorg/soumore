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

    //返回特定内容
    public function toSearchableArray()
    {
        #_ Read Data & Filter Field
        $Arr_Questions = array_only($this -> toArray(), ['title']);
        #_ Back to Scout
        return $Arr_Questions;
    }

    public function getCreatedAtAttribute($date)
    {
        if (Carbon::now() < Carbon::parse($date)->addDays(10))
        {
            return Carbon::parse($date);
        }
        return Carbon::parse($date)->diffForHumans();
    }


}
