<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\UserModel;
use App\Role;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Common\CommonController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    //用户列表
    public function index(Request $request) 
    {
    	$users = UserModel::paginate('16');
    	//用户所属角色
        return view('admin.user.index',['users'=>$users]);
    }
    
    //新增用户
    public function add()
    {
    	$roles = Role::all();
    	return view('admin.user.add',['roles'=>$roles]);
    }
    
    //保存新增用户
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(),[
	    		'username'=>'required',
    			'email'=>$request->isMethod('get')?'required|email|unique:users,email':'required|email',
    			'password'=>'required',
	    		'status'=>'required|numeric|between:0,1',
	    		'avatar'=>$request->file('avatar')?'image|max:2048':''
    	],[
    			'required'=>':attribute为必填项',
    			'numeric'=>'数字',
    			'image'=>'图片格式错误'
    	],[
    			'username'=>'名称',
    			'email'=>'邮箱',
    			'password'=>'密码',
    			'avatar'=>'头像',
    			'status'=>'状态',
    	]);
    
    	if(!$validator->fails())
    	{
    		//编辑更新保存
    		if(!empty($request->get('id')))
    		{
    			//图片不为空
    			if($request->file('avatar'))
	    		{
	    			//存储头像
	    			$imgPath = CommonController::ImgStore($request->file('avatar'),'avatar');
	    			UserModel::where('id','=',$request->get('id'))->update([
	    				'name'=>$request->get('username'),
	    				'email'=>$request->get('email'),
	    				'password'=>Hash::make($request->get('password')),
	    				'status'=>$request->get('status'),
	    				'avator'=>$imgPath
	    			]);
	    		}else{
	    			//无缩略图
	    			UserModel::where('id','=',$request->get('id'))->update([
	    				'name'=>$request->get('username'),
	    				'email'=>$request->get('email'),
	    				'password'=>Hash::make($request->get('password')),
	    				'status'=>$request->get('status'),
	    			]);
	    		}
	    		//角色不为空
	    		if(!empty($request->get('roles')))
	    		{
	    			//清除之前的角色
	    			DB::table('role_user')->where('user_id','=',$request->get('id'))->delete();
	    			$user = UserModel::where('id','=',$request->get('id'))->first();
	    			//用户分配角色
	    			foreach ($request->get('roles') as $role)
	    			{
	    				$user->roles()->attach($role);
	    			}
	    		}
	    		return redirect('/back/user/list');
    		}else{
    			//创建保存
	    		$user = new UserModel();
	    		$user->name = $request->get('username');
	    		$user->email = $request->get('email');
	    		$user->password = Hash::make($request->get('password'));
	    		$user->status = $request->get('status');
	    		$imgPath = '';
	    		if($request->file('avatar'))
	    		{
	    			//存储缩略图
	    			$imgPath = CommonController::ImgStore($request->file('avatar'),'avatar');
	    		}
	    		$user->avator = $imgPath;
	    		if($user->save())
	    		{
	    			//角色不为空
	    			if(!empty($request->get('roles')))
	    			{
    					//用户分配角色
    					foreach ($request->get('roles') as $role)
    					{
    						$user->roles()->attach($role);
    					}
	    			}
	    			
	    		}
	    		return redirect('/back/user/list');
    		}
    		
    	}
    	return redirect()->back()->withErrors($validator)->withInput();
    }
    
    //编辑用户
    public function edit(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:users,id'
    	]);
    	$user = UserModel::where('id','=',$request->get('id'))->get();
    	$roles = Role::all();
    	return view('admin.user.edit',[
    			'user'=>$user[0],
    			'roles'=>$roles
    	]);
    }
    
    //删除用户
    public function delete(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:users,id'
    	]);
    	
    	$result = User::where('id','=',$request->get('id'))->delete();
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
    
}
