<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\TagModel;
use App\Http\Controllers\Common\FileController;

class TagController extends Controller
{
    //
	public function index()
	{
		$datas = TagModel::paginate('18');
		return view('back.tag.index',['datas'=>$datas]);
	}
	
	//新增话题
	public function create()
	{
		return view('back.tag.create');
	}
	
	//保存话题
	public function store(Request $request)
	{
		$this->validate($request, [
				'name'=>'required|unique:category,name',
				'desc'=>'required',
				'thumb'=>'required|mimes:jpeg,png,jpg',
				'status'=>'required|numeric'
		],[
				'required'=>':attribute不能为空',
				'mimes'=>'图片格式错误',
				'unique'=>':attribute已存在'
		],[
				'name'=>'话题名称',
				'desc'=>'话题描述',
				'thumb'=>'缩略图',
		]);
		$file = $request->file('thumb');
		 
		$extention = $file->getClientOriginalExtension();
		//话题缩略图
		$filepath = FileController::saveCateImg($file,'topic');
		
		$result = TagModel::create([
				'name'=>$request->get('name'),
				'thumb'=>$filepath,
				'mime'=>$file->getClientMimeType(),
				'desc'=>$request->get('desc'),
				'status'=>$request->get('status')
		]);
		if($result)
		{
			return redirect('/back/tag');
		}
		return redirect()->back()->withErrors([
				'msg'=>'创建失败'
		]);
		
	}
	
	
	//编辑话题
	public function edit(Request $request)
	{
		$this->validate($request, [
			'id'=>'required|numeric|exists:tags,id'
		]);
		$datas = TagModel::paginate('5');
		$tag = TagModel::where('id',$request->get('id'))->get();
		return view('back.tag.index',['tag'=>$tag[0],'datas'=>$datas,'tid'=>$request->get('id')]);
	}
	
	//更新话题
	public function update(Request $request)
	{
		$this->validate($request, [
				'id'=>'required|numeric|exists:tags,id',
				'thumb'=>'required|mimes:jpeg,png,jpg',
		],[
				'required'=>':attribute不能为空',
				'mimes'=>'图片格式错误',
				'unique'=>':attribute已存在'
		],[
				'thumb'=>'缩略图',
		]);
		$file = $request->file('thumb');
		//话题缩略图
		$filepath = FileController::saveCateImg($file,'tags');
		$result = TagModel::updateOrCreate(array('id' => $request->get('id')), [
			'desc'=>$request->get('desc'),
			'thumb'=>$filepath
		]);
		if($result)
		{
			return redirect('/back/tag');
		}
		return redirect()->back()->withErrors([
				'msg'=>'创建失败'
		]);
	}
	
	
}
