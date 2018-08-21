<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class DynamicModel extends Model
{
    //用户动态表
    protected $table = 'dynamic';
    public $timestamps = TRUE;
    protected $fillable = ['uid','source_id','source_action','subject','deleted_at','created_at','updated_at'];
}
