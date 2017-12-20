<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;

class RoleController extends Controller
{
    //角色列表
    public function index()
    {
    	$datas = Role::orderBy('created_at','desc')->paginate('8');
    	return view('back.role.index',['datas'=>$datas]);
    }
    
    //新增角色
    public function create()
    {
    	return view('back.role.create');
    }
    
    //保存角色
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name'=>'required',
    		'display_name'=>'required'
    	]);
    	$owner = new Role();
		$owner->name = $request->get('name');
		$owner->display_name = $request->get('display_name');
		$owner->description = $request->get('description');
		if($owner->save())
		{
			return redirect()->action('Back\RoleController@index');
		}else{
			return redirect()->back();
		}
		
    }
    // 删除角色
    public function delete(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:roles,id'
    	]);
    	//删除该话题
    	$results = Role::where('id',$request->get('id'))->delete();
    	if($results)
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
}
