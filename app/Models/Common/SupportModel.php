<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class SupportModel extends Model
{
    //点赞
    protected $table = 'supports';
    public $timestamps = TRUE;
    protected $fillable = ['user_id','source_id','rating','source_type','deleted_at','created_at','updated_at'];
}
