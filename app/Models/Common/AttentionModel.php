<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class AttentionModel extends Model
{
    //关注表
	protected $table = 'attentions';
	protected $fillable = ['user_id','source_id','source_type','created_at','updated_at'];
}
