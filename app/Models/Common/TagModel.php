<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
	protected $table = 'tags';
	public $timestamps = TRUE;
	protected $fillable = ['name','thumb','desc','status','mime'];
	
}
