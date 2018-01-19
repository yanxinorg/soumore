<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\AreaModel;
use App\Models\Common\UserModel;

class CommonController extends Controller
{
	//存放无线级分类结果
	public static $treeList = array();
	
    //加载城市
 	public function loadCity($province_id)
    {
        $cities = AreaModel::where('parent_id',$province_id)->get();
        $city_options = '';
        foreach($cities as $city){
            $city_options .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }
        return response($city_options);

    }
    
    //分类树
    public static function treeCreate($data,$pid=0,$count = 1)
    {
    	foreach ($data as $key=>$value)
    	{
    		if($value['pid'] == $pid)
    		{
    			$value['count'] = $count;
    			self::$treeList[] = $value;
    			unset($data[$key]);
    			self::treeCreate($data,$value['id'],$count+1);
    		}
    	}
    	return self::$treeList;
    }
    
    //存储图片
    public static function ImgStore($file,$route = 'image')
    {
    	if($file->isValid())
    	{
    		$orignName = $file->getClientOriginalName();
    		$extension = $file->getClientOriginalExtension();
    		$name = strstr($orignName, '.'.$extension, TRUE);
    		$size = $file->getClientSize();
    		$destinationPath = 'storage/uploads/'.$route.'/'.$extension.'/'.date('Ymd').'/'; //public 文件夹下面建 storage/uploads 文件夹
    		$fileName = str_random(10).'.'.$extension;
    		$file->move($destinationPath, $fileName);
    		$filePath = asset($destinationPath.$fileName);
    		return $filePath;
    	}
    }
    
    
}
