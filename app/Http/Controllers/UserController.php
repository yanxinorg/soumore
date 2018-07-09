<?php

namespace App\Http\Controllers;

use App\Models\Common\AttentionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Common\UserModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;
use Ramsey\Uuid\Uuid;
use App\Http\Controllers\Common\SpecialCharacterController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
class UserController extends Controller
{
	protected  $Success = TRUE;
	protected  $Msg = "";
	protected  $Data = "";
	protected  $Code = "";
	//用户已存在
	const  User_Exists = 201;
	//用户不存在
	const  User_OK = 202;
	//用户名不能为空
	const User_Empty = 203;
	//用户名不合法
	const User_isLegal = 204;
    //检测用户是否存在
    public function isExist(Request $request)
    {
    	if(empty($request->get('username')))
    	{
    		$this->Success = false;
    		$this->Msg = "用户名不能为空!";
    		$this->Code = self::User_Empty;
    		return json_encode(['Success'=>$this->Success,'Msg'=>$this->Msg,'Code'=>$this->Code]);
    	}
    	//检验用户名是否合法
    	if(SpecialCharacterController::isUserLegal($request->get('username')))
    	{
    		$this->Success = false;
    		$this->Msg = "用户名不合法!";
    		$this->Code = self::User_isLegal;
    		return json_encode(['Success'=>$this->Success,'Msg'=>$this->Msg,'Code'=>$this->Code]);
    	}
    	$validator = Validator::make($request->all(),[
    		'username'=>'required|unique:users,name'
    	]);
    	if($validator->fails())
    	{
    		//用户已存在
    		$this->Success = false;
    		$this->Msg = "该用户已存在!";
    		$this->Code = self::User_Exists;
    	}else{
    		//用户名不存在
    		$this->Success = true;
    		$this->Msg = "";
    		$this->Code = self::User_OK;
    	}
    	return json_encode(['Success'=>$this->Success,'Msg'=>$this->Msg,'Code'=>$this->Code]);
    }
    
    //用户注册
    public function register(Request $request)
    {
    	$this->validate($request, [
    		'username'=>'required|unique:users,name|min:2|max:108',
    		'email'=>'required|unique:users,email|email',
    		'captcha'=>'required',
    		'password'=>'required|min:6|confirmed',
    		'password_confirmation'=>'required|min:6'
    	],[
    		'required'=>':attribute 不能为空',
    		'unique'=>':attribute 已存在',
    		'min'=>':attribute 至少 :min 位',
    		'max'=>':attribute 最多 :max 位',
    		'confirmed'=>'两次 :attribute 不一致'
    	],[
    		'username'=>'用户名',
    		'email'=>'邮箱',
    		'captcha'=>'验证码',
    		'password'=>'密码',
    		'password_confirmation'=>'重复密码',
    	]);
    	//验证验证码
    	$data = DB::table('captchas')
    			->where('email', $request->get('email'))
    			->where('type', '1')
    			->where('valid_time','>=',Carbon::now())
    			->where('email_code','=',$request->get('captcha'))
    			->get();
    	if(empty($data[0]))
    	{
    		return redirect()->back()->withErrors(['captcha'=>'验证码错误!'])->withInput() ;
    	}else{
    		//检测用户合法性
    		if(SpecialCharacterController::isUserLegal($request->get('username')))
    		{
    			return redirect()->back()->withErrors(['username'=>'用户名不合法!'])->withInput() ;
    		}
    		//存储用户
    		$result = UserModel::create([
    				'uid'=>(Uuid::uuid4()->getHex()),//生成全局UID
    				'name'=>$request->get('username'),
    				'email'=>$request->get('email'),
    				'password'=>bcrypt($request->get('password'))
    		]);
    		//注册成功 跳转登录页面
    		return redirect('/login')->with('result', '注册成功，请登录');;
    	}
    }
    //用户登录
    public function login(Request $request)
    {
    	$this->validate($request, [
    			'nameoremail'=>'required',
     			'captcha'=>'required',
    			'password'=>'required'
    	],[
    			'required'=>':attribute 不能为空',
    	],[
    			'nameoremail'=>'用户名/邮箱',
    			'captcha'=>'验证码',
    			'password'=>'密码'
    	]);
    	
//     	//验证码验证
     	if($request->get('captcha') !== Session::get('code'))
     	{
     		return redirect()->back()->withErrors(['captcha'=>'验证码错误'])->withInput();
     	}
    	//验证码密码
    	if(Auth::attempt(['email' => $request->get('nameoremail'), 'password' => $request->get('password')]) || Auth::attempt(['name' => $request->get('nameoremail'), 'password' => $request->get('password')]))
    	{
    		//验证成功 及 登录成功  todo
    		UserModel::updateOrCreate([
    			'id'=>Auth::id()
    		],[
    			'latest_login_time'=>Carbon::now(),
    			'latest_login_ip'=>$request->ip()
    		]);
    		return redirect('/index');
    	}
    	return redirect()->back()->withErrors(['nameoremail'=>'用户名或者密码错误'])->withInput(Input::except('password'));
    	
    }
    
    //登出
    public function logout()
    {
    	UserModel::updateOrCreate([
    			'id'=>Auth::id()
    	],[
    			'latest_logout_time'=>Carbon::now()
    	]);
    	Auth::logout();
    	return redirect('/login');
    }

    //热门用户
    public function index()
    {
        $users = UserModel::orderBy('count_fans','desc')->paginate('15');
        return view('ask.user.hotlist',['users'=>$users]);
    }

    //qq登录
    public function qqLogin()
    {
        return Socialite::with('qq')->redirect();
    }

    public function qqUrl()
    {
        $user = Socialite::driver('qq')->user();
        dd($user);
    }
}
