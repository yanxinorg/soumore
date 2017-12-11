<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\File;
use App\Http\Controllers\Common\FileController;
use App\Models\Common\CategoryModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Common\CommonController;

class CategoryController extends Controller
{
	
	//分类列表
	public function index()
    {
    	$datas = CategoryModel::all();
    	$trees = CommonController::treeCreate($datas);
    	return view('back.cate.index',[
    			'cates'=>$trees
    	]);
    	
    }
    
    //新增分类
    public function create()
    {
    	$cate = CategoryModel::where(['status'=>'1'])->get();
    	$trees = CommonController::treeCreate($cate);
    	return view('back.cate.create',[
    		'cates'=>$trees
    	]);
    }
    
    //编辑分类
    public function edit(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric'
    	]);
    	$trees = CategoryModel::where(['status'=>'1'])->get();
    	$trees = CommonController::treeCreate($trees);
    	$cate = DB::table('category')->where('id','=',$request->get('id'))->get();
    	return view('back.cate.edit',[
    			'cate'=>$cate[0],
    			'pids'=>$trees
    	]);
    }
    //添加子分类
    public function addChild(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric'
    	]);
    	$cates = CategoryModel::where('id','=',$request->get('id'))->get();
    	return view('back.cate.child',[
    			'pcates'=>$cates[0]
    	]);
    }
    
    //保存分类
    public function store(Request $request)
    {
    	$this->validate($request, [
    		   'pid'=>'required|numeric',
    	       'name'=>'required|unique:category,name',
    		   'thumb'=>'required|mimes:jpeg,png,jpg',
    	       'status'=>'required|numeric'
    	],[
    			'required'=>':attribute不能为空',
    			'mimes'=>'图片格式错误',
    			'unique'=>':attribute已存在'
    	],[
    			'name'=>'分类名称',
    			'thumb'=>'缩略图',
    	]);
    	$file = $request->file('thumb');
    	
    	$extention = $file->getClientOriginalExtension();
    	//分类缩略图
    	$filepath = FileController::saveCateImg($file,'category');
    	
    	$img = Image::make(storage_path().'/app/'.$filepath);
    	//压缩
    	$img->resize(30, 30);
    	
    	$fileName = uniqid(str_random(10)).'.'.$extention;
    	
    	$smallfilepath = 'category/'.gmdate("Y")."/".gmdate("m")."/".$fileName;
    	
    	$img->save(storage_path().'/app/'.$smallfilepath);

    	$result = CategoryModel::create([
    			'pid'=>$request->get('pid'),
    			'name'=>$request->get('name'),
    			'thumb'=>$filepath,
    			'thumb_small'=>$smallfilepath,
    			'mime'=>$file->getClientMimeType(),
    			'desc'=>$request->get('desc'),
    			'order'=>$request->get('order'),
    			'status'=>$request->get('status')
    	]);
    	if($result)
    	{
    		return redirect('/cate/index');
    	}
    	return redirect()->back()->withErrors([
    		'msg'=>'创建失败'
    	]);
    }

    // 删除分类
    public function delete(Request $request)
    {
     	$this->validate($request, [
            'id'=>'required|numeric'
        ]);
        $id = $request->get('id');
        //不能含有子分类
        $result = DB::table('category')->where('pid','=',$id)->get()->toArray();
        if(empty($result[0]))
        {
            //删除该分类
            $results = DB::table('category')->where('id','=',$id)->delete();
            if($results )
            {
                $data = [
                    'code'=>'1',
                    'msg'=>'删除成功'
                ];
            }else{
                $data = [
                    'code'=>'0',
                    'msg'=>'删除失败'
                ];
            }
            return $data;
        }else{
            $data = [
                'code'=>'2',
                'msg'=>'删除失败,不能包含子分类'
            ];
            return $data;
        }
           
    }
    
}
