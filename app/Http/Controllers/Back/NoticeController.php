<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\NoticeModel;

class NoticeController extends Controller
{
    //公告
    public function index()
    {
    	$data = NoticeModel::orderBy('created_at','desc')->first();
    	return view('back.notice.index',['data'=>$data]);
    }
    
    public function create(Request $request)
    {
    	NoticeModel::create([
    		'title'=>$request->get('title'),
    		'author'=>$request->get('author',''),
    		'url'=>$request->get('url',''),
    		'content'=>$request->get('content',''),
    		'status'=>$request->get('status')
    	]);
    	return redirect('back/notice');
    }
    
    public function edit(Request $request)
    {
    	$this->validate($request, [
    		'id'=>'required|numeric|exists:notice,id'
    	]);
    	$data = NoticeModel::where('id',$request->get('id'))->get();
    	
    	return view('back.notice.edit',['data'=>$data[0]]);
    }
    
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
