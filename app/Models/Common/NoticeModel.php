<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class NoticeModel extends Model
{
     //公告
	protected $table = 'notice';
	public $timestamps = TRUE;
	protected $fillable = ['title', 'author','content','url','status'];
}
