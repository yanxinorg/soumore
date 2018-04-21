<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TagModel extends Model
{
	protected $table = 'tags';
	public $timestamps = TRUE;
	protected $fillable = ['name','thumb','desc','status','mime'];
	
}
