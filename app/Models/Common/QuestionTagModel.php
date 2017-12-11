<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class QuestionTagModel extends Model
{
    //
	protected $table = 'question_tag';
	public $timestamps = TRUE;
	protected $fillable = ['questions_id','tags_id','created_at','updated_at'];
}
