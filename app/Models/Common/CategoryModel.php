<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CategoryModel extends Model
{
    use Searchable;
	//分类
	protected $table = 'category';
	public $timestamps = TRUE;
	protected $fillable = ['pid','name','thumb','thumb_small','desc','order','status','mime'];
	
	//存放无线级分类结果
	public static $treeList = array();
	
	public static function Lists($data,$pid=0,$count = 1)
	{
		foreach ($data as $key=>$value)
		{
			if($value['pid'] == $pid)
			{
				$value['count'] = $count;
				self::$treeList[] = $value;
				unset($data[$key]);
				self::Lists($data,$value['id'],$count+1);
			}
		}
		return self::$treeList;
	}

    //返回特定内容
    public function toSearchableArray()
    {
        $Arr_Cates = array_only($this -> toArray(), ['name']);
        return $Arr_Cates;
    }
}
