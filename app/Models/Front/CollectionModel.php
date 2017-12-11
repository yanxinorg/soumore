<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class CollectionModel extends Model
{
	//收藏表
	protected $table = 'collections';
	public $timestamps = TRUE;
	protected $fillable = ['user_id','source_id','source_type','title'];
}
