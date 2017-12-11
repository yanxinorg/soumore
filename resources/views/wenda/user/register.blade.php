@extends('layouts.wenda')
@section('content')
<style>
.main-content{
	background-color:white;
}
.register{
	background-color: #EFF0F4;
	margin-top:72px;
	padding:24px 0px;
}
.container .sendInput{
	width:80%;
  border-radius: 0px;
}
.container .sendEmail{
 	width:21%;
 	height:39px;
 	border:1px solid #3A90FF;
 	background-color:#3A90FF;
 	color:white;
}
.container .input-group{
  width: 100%;
}
.container .input-group .input-group-btn input{
  border-radius: 4px;
}
.container .input-group .input-group-btn a{
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}
.container .input-group-btn a{
  text-decoration: none;
}
.container .tipinfo{
  color: red;
}
</style>
<div class="container">
  <div class="col-md-12 col-sm-12 register" >
      <form class="form-signin" action="{{ url('/register') }}" id="register" method="post">
      {{ csrf_field() }}
        <div class="login-wrap">
            <div class="input-group">
                <div class="input-group-btn">
                  <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="用户名" class="form-control">
                </div>
            </div>
             @if ($errors->has('username'))
             <div class="alert alert-danger ">
                 {{ $errors->first('username') }}
             </div>
             @endif
            <div class="input-group">
                <div class="input-group-btn" >
                  <input type="text"  id="email" name="email" value="{{ old('email') }}" placeholder="邮箱" class="sendInput form-control">
                  <a class="sendEmail btn btn-primary" id="second" value="">发送</a>
                </div>
            </div>
             @if ($errors->has('email'))
             <div class="alert alert-danger ">
                 {{ $errors->first('email') }}
             </div>
             @endif
            <div class="input-group" >
              <div class="input-group-btn">
                <input type="text" name="captcha" value="{{ old('captcha') }}" placeholder="邮箱验证码" class="form-control">
              </div>
            </div>
             @if ($errors->has('captcha'))
             <div class="alert alert-danger ">
                 {{ $errors->first('captcha') }}
             </div>
             @endif
            <div class="input-group" >
              <div class="input-group-btn">
                <input type="password" name="password" value="{{ old('password') }}" id="password" placeholder="密码" class="form-control">
              </div>
            </div>
             @if ($errors->has('password'))
             <div class="alert alert-danger ">
                  {{ $errors->first('password') }}
             </div>
             @endif
            <div class="input-group">
              <div class="input-group-btn">
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="重复密码" class="form-control">
              </div>
            </div>
             @if ($errors->has('password_confirmation'))
             <div class="alert alert-danger ">
                 {{ $errors->first('password_confirmation') }}
             </div>
             @endif
            <button type="submit" class="btn btn-lg btn-login btn-block"><span>注册</span></button>
            <div class="registration">已有账户?<a class="" href="{{ url('/login') }}">登录</a></div>
        </div>
    </form>
  </div>
</div>
@section('js')
@parent
<!-- 弹层 -->
<script src="{{ asset('wenda/layer/layer.js') }}"></script>
<script src="{{ asset('wenda/common/js/jquery.cookie.js') }}"></script>
<script type="text/javascript">
//发送验证码时添加cookie
function addCookie(name,value,expiresHours)
{ 
//判断是否设置过期时间,0代表关闭浏览器时失效
  if(expiresHours>0)
  { 
    var date = new Date(); 
    date.setTime(date.getTime() + expiresHours*1000); 
    $.cookie(name, escape(value), {expires: date});
  }else{
    $.cookie(name, escape(value));
  }
} 
//修改cookie的值
function editCookie(name,value,expiresHours)
{ 
  if(expiresHours>0){ 
  var date=new Date(); 
  date.setTime(date.getTime()+expiresHours*1000); 
  //单位是毫秒
  $.cookie(name, escape(value), {expires: date});
  }else{
    $.cookie(name, escape(value));
  }
}
//根据名字获取cookie的值
function getCookieValue(name)
{ 
  return $.cookie(name);
}

$(function()
{
  $("#second").click(function ()
  {
    sendCode($("#second"));
  });
  //获取cookie值
  v = getCookieValue("secondsremained");
  if(v>0){
    //开始倒计时
    settime($("#second"));
    }
});
//发送验证码
function sendCode(obj)
{
  var email = $("#email").val();
  var result = isEmail(email);
  if(result)
    {
      //进行ajax调用
      $.post("{{ url('/email/captcha') }}",
        {
        "_token":'{{ csrf_token() }}',
        "email": email,
        },function(data){
            var datas = JSON.parse(data); 
            if(!datas.Success)
            {
            	layer.msg(datas.Msg);
            	return;
            }else{
            	layer.msg(datas.Msg);
                //添加cookie记录,有效时间60s
                addCookie("secondsremained",60,60);
                //开始倒计时
                settime(obj);
            }
       });
    }
}
var countdown;
function settime(obj)
{ 
  countdown = getCookieValue("secondsremained");
  if(countdown == undefined) 
  { 
    obj.removeAttr("disabled"); 
    obj.text("发送"); 
    return;
  }else{
    obj.attr("disabled",true); 
    obj.text(+ countdown + "秒"); 
    countdown--;
    editCookie("secondsremained",countdown,countdown+1);
  } 
  //每1000毫秒执行一次
  setTimeout(function() { 
    settime(obj); 
  },1000) 
}
//校验邮箱是否合法
function isEmail()
{
  var email = $("#email").val();
  var myreg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/; 
  if(!myreg.test(email))
    { 
      layer.msg('请输入有效的邮箱地址');
      return false;
    }else{
      return true;
    }
}
//检测用户是否已经存在
$("#username").change(function(){
	  var username = $("#username").val();
	  //进行ajax调用
      $.post("{{ url('/user/check') }}",
        {
        "_token":'{{ csrf_token() }}',
        "username": username,
        },function(data){
            var datas = JSON.parse(data); 
            if(!datas.Success && datas.Code == 201)
            {
            	layer.msg(datas.Msg);
            	return;
            }else if(!datas.Success && datas.Code == 204)
            {
            	layer.msg(datas.Msg);
            	return;
            }
       });
});
</script>
@stop
@endsection

