<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class VideoModel extends Model
{
    //视频表
    protected $table = 'videos';
    public $timestamps = TRUE;
    protected $fillable = ['user_id','cate_id','title','excerpt','content','thumb','url','status','mime'];
}
