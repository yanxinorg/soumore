<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\LinkModel;
use App\Models\Common\CategoryModel;
use App\Http\Controllers\Common\CommonController;
use App\Models\Common\TagModel;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    //链接列表
    public function index()
    {
    	$links = LinkModel::all();
    	return view('admin.link.index',['links'=>$links]);
    }
    
    //新增链接
    public function add()
    {
    	$cates = CategoryModel::all();
    	$cates = CommonController::treeCreate($cates);
    	$tags = TagModel::all();
    	return view('admin.link.add',['cates'=>$cates,'tags'=>$tags]);
    }
    
    //保存链接
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(),[
    			'name'=>'required',
    			'url'=>'required|url',
    			'status'=>'required|numeric|between:0,1',
    			'thumb'=>$request->file('thumb')?'image|max:2048':''
    	],[
    			'required'=>':attribute为必填项',
    			'numeric'=>'数字',
    			'image'=>'图片格式错误'
    	],[
    			'name'=>'链接名称',
    			'url'=>'链接地址',
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
    				$imgPath = CommonController::ImgStore($request->file('thumb'),'link');
    				LinkModel::where('id','=',$request->get('id'))->update([
    						'name'=>$request->get('name'),
    						'url'=>$request->get('url'),
    						'status'=>$request->get('status'),
    						'cate_id'=>$request->get('cate_id'),
    						'tag_id'=>$request->get('tag_id'),
    						'desc'=>$request->get('desc'),
    						'thumb'=>$imgPath
    				]);
    			}else{
    				//无缩略图
    				LinkModel::where('id','=',$request->get('id'))->update([
    						'name'=>$request->get('name'),
    						'url'=>$request->get('url'),
    						'status'=>$request->get('status'),
    						'cate_id'=>$request->get('cate_id'),
    						'tag_id'=>$request->get('tag_id'),
    						'desc'=>$request->get('desc'),
    				]);
    			}
    			return redirect('/back/link/list');
    		}else{
    			//创建保存
    			$link = new LinkModel();
    			$link->name = $request->get('name');
    			$link->url = $request->get('url');
    			$link->status = $request->get('status');
    			$link->cate_id = $request->get('cate_id');
    			$link->tag_id = $request->get('tag_id');
    			$link->desc = $request->get('desc');
    			$imgPath = '';
    			if($request->file('thumb'))
    			{
    				//存储缩略图
    				$imgPath = CommonController::ImgStore($request->file('thumb'),'link');
    			}
    			$link->thumb = $imgPath;
    			if($link->save())
    			{
    				return redirect('/back/link/list');
    			}
    		}
    	
    	
    	}
    	return redirect()->back()->withErrors($validator)->withInput();
    }
    
    //编辑链接
    public function edit(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:links,id'
    	]);
    	$trees = CategoryModel::all();
    	$trees = CommonController::treeCreate($trees);
    	$link =  LinkModel::where('id','=',$request->get('id'))->get();
    	$tags =  TagModel::all();
    	return view('admin.link.edit',[
    			'link'=>$link[0],
    			'pids'=>$trees,
    			'tags'=>$tags
    	]);
    }
    
    //删除链接
    public function delete(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:links,id'
    	]);
    	$result = LinkModel::where('id','=',$request->get('id'))->delete();
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
    			'id'=>'required|numeric|exists:links,id'
    	]);
    	if(LinkModel::where(['id'=>$request->get('id'),'status'=>'1'])->update(['status'=>'0']) || LinkModel::where(['id'=>$request->get('id'),'status'=>'0'])->update(['status'=>'1']))
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
