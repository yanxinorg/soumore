<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\PostModel;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common\UserModel;
use App\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use Qiniu\Storage\UploadManager;

class UserController extends Controller
{
    //用户列表
    public function index(Request $request) 
    {
        $users = UserModel::paginate('16');
        $roles = Role::all();
        return view('admin.user.index',['users'=>$users,'roles'=>$roles,'wd'=>$request->get('wd')?$request->get('wd'):'']);
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
    			'email'=>'required|email|unique:users,email',
    			'password'=>'required|min:6',
	    		'status'=>'required|numeric|between:0,1',
	    		'avatar'=>$request->file('avatar')?'image|max:2048':''
    	],[
    			'required'=>':attribute为必填项',
    			'numeric'=>'数字',
    			'image'=>'图片格式错误',
                'unique'=>':attribute已存在'
    	],[
    			'username'=>'名称',
    			'email'=>'邮箱',
    			'password'=>'密码',
    			'avatar'=>'头像',
    			'status'=>'状态',
    	]);
    	if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //创建保存
        $user = new UserModel();
        $user->uid = (\Ramsey\Uuid\Uuid::uuid4()->getHex());
        $user->name = $request->get('username');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->status = $request->get('status');
        $imgPath = '';
        if($request->file('avatar'))
        {
            $filePath = $request->file('avatar');
            $type = $request->file('avatar')->getMimeType();
            $upManager = new UploadManager();
            $auth = new \Qiniu\Auth(env('QINIU_ACCESS_KEY'), env('QINIU_SECRET_KEY'));
            $token = $auth->uploadToken(env('QINIU_BUCKET'));
            $key = md5(time().rand(1,9999));
            list($ret,$error) = $upManager->putFile($token,$key,$filePath,null,$type,false);
            if($error){
                return redirect()->back()->withErrors(['error'=>'头像更新失败']);
            }else{
                $imgPath = env('QINIU_DOMAIN').'/'.$ret['key'];
            }
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
    
    //编辑用户
    public function edit(Request $request)
    {
    	$this->validate($request, [
    			'id'=>'required|numeric|exists:users,id'
    	]);
    	$user = UserModel::where('id',$request->get('id'))->get();
    	$roles = Role::all();
        $selectedRoles = DB::table('role_user')
            ->leftjoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->leftjoin('users', 'role_user.user_id', '=', 'users.id')
            ->where('users.id',$request->get('id'))
            ->pluck('roles.id as role_id')->toArray();
    	return view('admin.user.edit',[
    			'user'=>$user[0],
    			'roles'=>$roles,
                'selectedRoles'=>$selectedRoles
    	]);
    }
    //更新用户
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id'=>'required|numeric|exists:users,id',
            'username'=>'required',
            'email'=>'required|email',
            'newpassword'=>$request->get('bewpassword')?'required|min:6':'',
            'status'=>'required|numeric|between:0,1',
            'avatar'=>$request->file('avatar')?'image|max:2048':''
        ],[
            'required'=>':attribute为必填项',
            'numeric'=>'数字',
            'image'=>'图片格式错误'
        ],[
            'username'=>'名称',
            'email'=>'邮箱',
            'newpassword'=>'新密码',
            'avatar'=>'头像',
            'status'=>'状态',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //新密码存在
        if($request->get('newpassword'))
        {
            $data = [
                'name'=>$request->get('username'),
                'email'=>$request->get('email'),
                'password'=>Hash::make($request->get('newpassword')),
                'status'=>$request->get('status')
            ];
        }else{
            $data = [
                'name'=>$request->get('username'),
                'email'=>$request->get('email'),
                'status'=>$request->get('status')
            ];
        }
        //图片不为空
        if($request->file('avatar'))
        {
            $filePath = $request->file('avatar');
            $type = $request->file('avatar')->getMimeType();
            $upManager = new UploadManager();
            $auth = new \Qiniu\Auth(env('QINIU_ACCESS_KEY'), env('QINIU_SECRET_KEY'));
            $token = $auth->uploadToken(env('QINIU_BUCKET'));
            $key = md5(time().rand(1,9999));
            list($ret,$error) = $upManager->putFile($token,$key,$filePath,null,$type,false);
            if($error){
                return redirect()->back()->withErrors(['error'=>'头像更新失败']);
            }else{
                $data['avator'] = env('QINIU_DOMAIN').'/'.$ret['key'];
            }
            UserModel::where('id','=',$request->get('id'))->update($data);
        }else{
            //无缩略图
            UserModel::where('id','=',$request->get('id'))->update($data);
        }
        //清除之前的角色
        DB::table('role_user')->where('user_id','=',$request->get('id'))->delete();
        //角色不为空
        if(!empty($request->get('roles')))
        {
            $user = UserModel::where('id','=',$request->get('id'))->first();
            //用户分配角色
            foreach ($request->get('roles') as $role)
            {
                $user->roles()->attach($role);
            }
        }
        return redirect('/back/user/list');
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

    //更改状态
    public function status(Request $request)
    {
        $this->validate($request, [
            'id'=>'required|numeric|exists:users,id'
        ]);
        if(UserModel::where(['id'=>$request->get('id'),'status'=>'1'])->update(['status'=>'0']) || UserModel::where(['id'=>$request->get('id'),'status'=>'0'])->update(['status'=>'1']))
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
