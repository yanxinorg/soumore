<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class PostTagModel extends Model
{
	protected $table = 'post_tag';
	public $timestamps = TRUE;
	protected $fillable = ['posts_id','tags_id','created_at','updated_at'];
}
