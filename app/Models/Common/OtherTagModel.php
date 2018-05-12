<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class OtherTagModel extends Model
{
    //
    protected $table = 'other_tag';
    public $timestamps = TRUE;
    protected $fillable = ['posts_id','questions_id','videos_id','tags_id','created_at','updated_at'];
}
