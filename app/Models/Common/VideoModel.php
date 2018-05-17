<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class VideoModel extends Model
{
    use Searchable;
    //视频表
    protected $table = 'videos';
    public $timestamps = TRUE;
    protected $fillable = ['user_id','cate_id','title','excerpt','content','thumb','url','status','mime'];


    //返回特定内容
    public function toSearchableArray()
    {
        #_ Read Data & Filter Field
        $Arr_Videos = array_only($this -> toArray(), ['title']);
        #_ Back to Scout
        return $Arr_Videos;
    }
}
