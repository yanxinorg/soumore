<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TagModel extends Model
{
    use Searchable;
	protected $table = 'tags';
	public $timestamps = TRUE;
	protected $fillable = ['name','thumb','desc','status','mime'];

    //返回特定内容
    public function toSearchableArray()
    {
        #_ Read Data & Filter Field
        $Arr_Tags = array_only($this -> toArray(), ['name']);
        #_ Back to Scout
        return $Arr_Tags;
    }

}
