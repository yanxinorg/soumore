<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    //
	protected $table = 'messages';
	protected $fillable = ['from_user_id','to_user_id','content','is_read','from_deleted','to_deleted','created_at','updated_at'];
}
