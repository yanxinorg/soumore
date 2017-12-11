@extends('layouts.wenda')
@section('content')
<style>
.main-content{
	background-color:white;
}
.login {
	background-color: #EFF0F4;
	margin-top:72px;
	padding:24px 0px;
}
.container .InputCaptcha{
    width: 60%;
}
.container .InputImg{
    width: 40%;
    height: 39px;
}
.container .third-party{
    border-top:1px solid #EFF0F4;
    text-align:center;
}
.container .auth-clients li{
    display: inline-block;
}
.container .auth-clients li:first-child{
    margin-left: -42px;
}
.container  .third-party img{
    width: 28px;
    height: 28px;
    margin: 0 4px;
}
.container .input-group .input-group-btn input{
	border-radius:4px;
}
.container .input-group-btn img{
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}
.container .tipinfo{
  color: red;
}
.container .other{
  margin-top:-78px;
}
</style>
<div class="container">
<div class="col-md-12 col-sm-12 login" >
    <form class="form-signin" action="{{ url('/login') }}" method="post">
        <div class="login-wrap">
        {{ csrf_field() }}
        @if (session('result'))
		    <div class="alert alert-success ">
		        {{ session('result') }}
		    </div>
		@endif
         <div class="input-group">
            <div class="input-group-btn">
               <input type="text" class="form-control" name="nameoremail" value="{{ old('nameoremail') }}" placeholder="用户名   / 邮箱" >
            </div>
         </div>
         @if ($errors->has('nameoremail'))
            <div class="alert alert-danger ">
                 {{ $errors->first('nameoremail') }}
            </div>
         @endif
         <div class="input-group" >
              <div class="input-group-btn">
                <input type="password" class="form-control" name="password" value="{{ old('password') }}"  placeholder="密码">
              </div>
         </div>
         @if ($errors->has('password'))
             <div class="alert alert-danger">
                 {{ $errors->first('password') }}
             </div>
         @endif
        <div class="input-group">
             <span class="input-group-btn" >
                 <input type="text" class="form-control InputCaptcha" name="captcha" placeholder="验证码">
                    <a onclick="javascript:re_captcha();" >
                       <img src="{{ url('/captcha/1') }}"  alt="验证码" title="刷新图片" class="InputImg"  id="c2c98f0de5a04167a9e427d883690ff6" border="0">
                    </a>
             </span>
        </div>
        @if ($errors->has('captcha'))
             <div class="alert alert-danger " >
                  <span>{{ $errors->first('captcha') }}</span>
             </div>
        @endif
        <button class="btn btn-lg btn-login btn-block" type="submit">登录</button>
        </div>
    </form>
   <div class="other">
   	   <div class="registration">没有账户?<a class="" href="{{ url('/register') }}">注册</a></div>
	   <div class="registration" ><a data-toggle="modal" href="#myModal">忘记密码?</a></div>
	   <div class="registration third-party"><span>第三方登录</span>
	       <ul class="auth-clients">
	          <li>
	             <a class="auth-link-QQ" href="{{ url('/auth/qq') }}" title="QQ登录">
	                <img src="{{ asset('wenda/user/login/images/qq.png') }}">
	             </a>
	          </li>
	          <li >
	             <a class="auth-link-Weixin" href="{{ url('/auth/weixin') }}" title="微信登录">
	                <img src="{{ asset('wenda/user/login/images/weixin.png') }}">
	             </a>
	          </li>
	          <li>
	             <a class="auth-link-Weibo" href="{{ url('/auth/weibo') }}" title="微博登录">
	                <img src="{{ asset('wenda/user/login/images/weibo.png') }}">
	             </a>
	          </li>
	      </ul>
	   </div>
   </div>

<!-- 找回密码 -->
   <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
      <div class="modal-dialog">
           <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">忘记密码 ?</h4>
                </div>
           <form>
                <div class="modal-body"><p>请输入注册邮箱</p>
                    <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control ">
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                    <button class="btn btn-primary" type="button">提交</button>
                </div>
          </form>
         </div>
      </div>
   </div>
<!-- modal -->
</div>
</div>
<script>  
  function re_captcha() {
    $url = "{{ url('/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
  }
</script>
@endsection
