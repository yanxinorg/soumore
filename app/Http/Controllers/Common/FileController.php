<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Common\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\Common\PostModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;
use App\Models\Common\UserModel;
use App\Models\Common\TagModel;

class FileController extends Controller
{
    //存储分类缩略图
    public static function saveCateImg($file,$route = 'category')
    {
    	if($file->isValid())
    	{
    		$extension = $file->getClientOriginalExtension();
    		$fileName = uniqid(str_random(10)).'.'.$extension;
    		$destinationPath = $route.'/'.gmdate("Y")."/".gmdate("m")."/".$fileName; 
    		$result = Storage::disk('local')->put($destinationPath,\Illuminate\Support\Facades\File::get($file));
    		if($result)
    		{
    			return $destinationPath;
    		}
    	}
    }
    
	//获取分类缩略图
    public function getCateImg($id)
    {
    	$thumb = CategoryModel::where('id', '=', $id)->get();
    	$file = Storage::disk('local')->get($thumb[0]['thumb_small']);
    	return (new Response($file, 200))->header('Content-Type', $thumb[0]->mime);
    }
    
    //获取标签缩略图
    public function getTagImg($id)
    {
    	$thumb = TagModel::where('id', '=', $id)->get();
    	$file = Storage::disk('local')->get($thumb[0]['thumb']);
    	return (new Response($file, 200))->header('Content-Type', $thumb[0]->mime);
    }
    
    //获取文章缩略图
    public function getPostImg($id)
    {
        $thumb = PostModel::where('id', '=', $id)->get();
        $file = Storage::disk('local')->get($thumb[0]['thumb_small']);
        return (new Response($file, 200))->header('Content-Type', $thumb[0]->mime);
    }
    
    //文章编辑器上传图片
    public function uploadImg(Request $request)
    {
    	$this->validate($request, [
    		'file'=>'sometimes|mimes:jpg,jpeg,png,gif'
    	]);
    	if($request->hasFile('file')){
    		$file = $request->file('file');
    		
    		$extension = $file->getClientOriginalExtension();
    		
    		$basepath = uniqid(str_random(8)).'.'.$extension;
    		
    		$filePath = 'public/'.$basepath;
    		//存入图片
    		Storage::disk('local')->put($filePath,File::get($file));
  
    		//返回取得该图片的url地址
    		return $basepath;
    	}
    }
    //文章编辑器图片获取
    public function getPostImgs(Request $request)
    {
    	$tmpArr = explode('/', $request->url());
    	$file = Storage::disk('local')->get('public/'.$tmpArr[5]);
    	return (new Response($file, 200))->header('Content-Type', 'image/jpeg');
    }
    
    
    //存储文章缩略图
    public static function savePostImg($file,$route = 'article')
    {
    	if($file->isValid())
    	{
    		$extension = $file->getClientOriginalExtension();
    		$fileName = uniqid(str_random(10)).'.'.$extension;
    		$destinationPath = $route.'/'.gmdate("Y")."/".gmdate("m")."/".$fileName;
    		$result = Storage::disk('local')->put($destinationPath,\Illuminate\Support\Facades\File::get($file));
    		return $destinationPath;
    	}
    }
    
    //存储分类缩略图
    public static function saveThumbImg($file,$route = 'avator')
    {
    	if($file->isValid())
    	{
    		$extension = $file->getClientOriginalExtension();
    		$fileName = uniqid(str_random(10)).'.'.$extension;
    		$destinationPath = $route.'/'.gmdate("Y")."/".gmdate("m")."/".$fileName;
    		$result = Storage::disk('local')->put($destinationPath,\Illuminate\Support\Facades\File::get($file));
    		if($result)
    		{
    			return $destinationPath;
    		}
    	}
    }
    
    //获取分类缩略图
    public function getThumbImg($id)
    {
    	$thumb = UserModel::where('id', '=',$id)->get();
    	$file = Storage::disk('local')->get($thumb[0]['avator']);
    	return (new Response($file, 200))->header('Content-Type', $thumb[0]->mime);
    }
    
 	
}
