<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\CategoryModel;
use App\Http\Controllers\Common\CommonController;
use Illuminate\Support\Facades\Validator;
use Qiniu\Storage\UploadManager;

class CateController extends Controller
{
    //分类列表
    public function index(Request $request)
    {
        $cates = CategoryModel::all();
    	$cates = CommonController::treeCreate($cates);
    	return view('admin.cate.index',['cates'=>$cates,'wd'=>$request->get('wd')?$request->get('wd'):'']);
    }
    
    //新增分类
    public function add()
    {
        $cates = CategoryModel::all();
        $cates = CommonController::treeCreate($cates);
    	return view('admin.cate.add',['cates'=>$cates]);
    }
    
    //保存新增分类
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(),[
    			'cateid'=>'required|numeric',
	    		'name'=>'required',
	    		'status'=>'required|numeric|between:0,1',
	    		'thumb'=>$request->file('thumb')?'image|max:2048':''
    	],[
    			'required'=>':attribute为必填项',
    			'numeric'=>'数字',
    			'image'=>'图片格式错误'
    	],[
    			'cateid'=>'父级分类',
    			'name'=>'分类名称',
    			'thumb'=>'缩略图',
    			'status'=>'分类状态',
    	]);
    	 
    	if(!$validator->fails())
    	{
    		//编辑更新保存
    		if(!empty($request->get('id')))
    		{
    			//图片不为空
    			if($request->file('thumb'))
	    		{
	    			//存储缩略图
                    $filePath = $request->file('thumb');
                    $type = $request->file('thumb')->getMimeType();
                    $upManager = new UploadManager();
                    $auth = new \Qiniu\Auth(env('QINIU_ACCESS_KEY'), env('QINIU_SECRET_KEY'));
                    $token = $auth->uploadToken(env('QINIU_BUCKET'));
                    $key = md5(time().rand(1,9999));
                    list($ret,$error) = $upManager->putFile($token,$key,$filePath,null,$type,false);
                    if($error){
                        return redirect()->back()->withErrors(['error'=>'保存失败']);
                    }else{
                        $imgPath = env('QINIU_DOMAIN').'/'.$ret['key'];
                    }
	    			CategoryModel::where('id','=',$request->get('id'))->update([
	    				'pid'=>$request->get('cateid'),
	    				'name'=>$request->get('name'),
	    				'status'=>$request->get('status'),
	    				'desc'=>$request->get('desc'),
	    				'thumb'=>$imgPath
	    			]);
	    		}else{
	    			//无缩略图
	    			CategoryModel::where('id','=',$request->get('id'))->update([
	    					'pid'=>$request->get('cateid'),
	    					'name'=>$request->get('name'),
	    					'status'=>$request->get('status'),
	    					'desc'=>$request->get('desc')
	    			]);
	    		}
	    		return redirect('/back/cate/list');
    		}else{
    			//创建保存
	    		$cate = new CategoryModel();
	    		$cate->pid = $request->get('cateid');
	    		$cate->name = $request->get('name');
	    		$cate->status = $request->get('status');
	    		$cate->desc = $request->get('desc');
	    		$imgPath = '';
	    		if($request->file('thumb'))
	    		{
	    			//存储缩略图
                    $filePath = $request->file('thumb');
                    $type = $request->file('thumb')->getMimeType();
                    $upManager = new UploadManager();
                    $auth = new \Qiniu\Auth(env('QINIU_ACCESS_KEY'), env('QINIU_SECRET_KEY'));
                    $token = $auth->uploadToken(env('QINIU_BUCKET'));
                    $key = md5(time().rand(1,9999));
                    list($ret,$error) = $upManager->putFile($token,$key,$filePath,null,$type,false);
                    if($error){
                        return redirect()->back()->withErrors(['error'=>'保存失败']);
                    }else{
                        $imgPath = env('QINIU_DOMAIN').'/'.$ret['key'];
                    }
//	    			$imgPath = CommonController::ImgStore($request->file('thumb'),'category');
	    		}
	    		$cate->thumb = $imgPath;
	    		if($cate->save())
	    		{
	    			return redirect('/back/cate/list');
	    		}
    		}
    	}
    	return redirect()->back()->withErrors($validator)->withInput();
    }
    //编辑分类
    public function edit(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:category,id'
    	]);
    	$trees = CategoryModel::all();
    	$trees = CommonController::treeCreate($trees);
    	$cate =  CategoryModel::where('id','=',$request->get('id'))->get();
    	return view('admin.cate.edit',[
    			'cate'=>$cate[0],
    			'pids'=>$trees
    	]);
    }
    
    //添加子分类
    public function addChild(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:category,id'
    	]);
    	$cate = CategoryModel::where('id','=',$request->get('id'))->get();
    	return view('admin.cate.child',[
    			'cate'=>$cate[0]
    	]);
    }
    
    //删除分类
    public function delete(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:category,id'
    	]);
    	//不能含有子分类
    	if(CategoryModel::where('pid', '=', $request->get('id'))->exists())
    	{
    		$data = [
    				'code'=>'2',
    				'msg'=>'删除失败,不能包含子分类'
    		];
    		return $data;
    	}
    	$result = CategoryModel::where('id','=',$request->get('id'))->delete();
    	if($result)
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
    }
    
    //更改状态
    public function status(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:category,id'
    	]);
    	if(CategoryModel::where(['id'=>$request->get('id'),'status'=>'1'])->update(['status'=>'0']) || CategoryModel::where(['id'=>$request->get('id'),'status'=>'0'])->update(['status'=>'1']))
    	{
    		$data = [
    				'code'=>'1',
    				'msg'=>'更新成功!'
    		];
    	}else{
    		$data = [
    				'code'=>'0',
    				'msg'=>'更新失败!'
    		];
    	}
    	return $data;
    	
    }
    
}
