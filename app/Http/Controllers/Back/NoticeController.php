<?php

namespace App\Http\Controllers\Back;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\NoticeModel;

class NoticeController extends Controller
{
    //公告列表
    public function index()
    {
    	$data = NoticeModel::orderBy('created_at','desc')->get();
    	return view('back.notice.index',['datas'=>$data]);
    }
    
    public function create(Request $request)
    {
    	if (\Illuminate\Support\Facades\Request::isMethod('get'))
		{
		    return view('back.notice.create');
		}
		//新增公告
    	NoticeModel::create([
    		'title'=>$request->get('title'),
    		'author'=>$request->get('author',''),
    		'url'=>$request->get('url',''),
    		'content'=>$request->get('content',''),
    		'status'=>$request->get('status')
    	]);
    	return redirect('back/notice');
    }
    //编辑公告
    public function edit(Request $request)
    {
    	$this->validate($request, [
    		'id'=>'required|numeric|exists:notice,id'
    	]);
    	$data = NoticeModel::where('id',$request->get('id'))->get();
    	
    	return view('back.notice.edit',['data'=>$data[0]]);
    }
    
	//公告删除
    public function delete(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:notice,id'
    	]);
    	$data = NoticeModel::where('id',$request->get('id'))->delete();
    	return redirect()->back();
    }
    
    //公告更新
    public function update(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:notice,id'
    	]);
    	NoticeModel::updateOrCreate([
    			'id'=>$request->get('id')
    	],[
    			'title'=>$request->get('title'),
    			'author'=>$request->get('author',''),
    			'url'=>$request->get('url',''),
    			'content'=>$request->get('content',''),
    			'status'=>$request->get('status')
    	]);
    	return redirect('back/notice');
    }
}
