<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

class OtherTagModel extends Model
{
    //
    protected $table = 'other_tag';
    public $timestamps = TRUE;
    protected $fillable = ['source_id','source_type','tag_id','created_at','updated_at'];
}
