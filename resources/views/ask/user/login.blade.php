<!DOCTYPE html>
<!-- saved from url=(0031)http://ask.com/?/account/login/ -->
<html class=""><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
<meta name="renderer" content="webkit">
<title>登录SOUMORE</title>
<!--<base href="http://ask.com/?/">--><base href="."><!--[if IE]></base><![endif]-->
<link rel="stylesheet" type="text/css" href="{{ asset('ask/login_files/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ask/login_files/icon.css') }}">
<link href="{{ asset('ask/login_files/common.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/login_files/link.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/login_files/style.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/login_files/login.css') }}" rel="stylesheet" type="text/css">
<script src="{{ asset('ask/login_files/jquery.2.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/login_files/jquery.form.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/login_files/plug-in_module.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/login_files/aws.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('ask/login_files/compatibility.js') }}"></script>
<style type="text/css">.fancybox-margin{margin-right:0px;}</style>
<body screen_capture_injected="true">
<div id="wrapper">
	<div class="aw-login-box">
		<div class="mod-body clearfix">
			<div class="content pull-left">
				<h2>用户登陆</h2>
				<form id="login_form" method="post" action="{{ url('/login') }}">
					{{ csrf_field() }}
					<ul>
						@if ($errors->has('success'))
							<li class="alert alert-success error_message">
								<i class="icon icon-delete"></i>
								<em>
									{{ $errors->first('success') }}
								</em>
							</li>
						@endif

						<li>
							<input type="text" id="aw-login-user-name" class="form-control" placeholder="邮箱 /用户名" name="nameoremail" value="{{ old('nameoremail') }}">
						</li>
						@if ($errors->has('nameoremail'))
							<li class="alert alert-danger error_message">
								<i class="icon icon-delete"></i>
								<em>
									{{ $errors->first('nameoremail') }}
								</em>
							</li>
						@endif
						<li>
							<input type="password" id="aw-login-user-password" class="form-control" placeholder="密码" name="password" value="{{ old('password') }}" >
						</li>
						@if ($errors->has('password'))
						 <li class="alert alert-danger error_message">
							<i class="icon icon-delete"></i>
							<em>
							 {{ $errors->first('password') }}
							</em>
						</li>
						@endif
						<li>
							<div class="input-group col-md-8">
							 <span class="input-group-btn" >
								 <input type="text" class="form-control InputCaptcha" name="captcha" placeholder="验证码">
									<a onclick="javascript:re_captcha();" >
									   <img src="{{ url('/captcha/1') }}"  alt="验证码" title="刷新图片" class="InputImg"  id="c2c98f0de5a04167a9e427d883690ff6" border="0">
									</a>
							 </span>
							</div>
						</li>
						@if ($errors->has('captcha'))
							<li class="alert alert-danger error_message">
								<i class="icon icon-delete"></i>
								<em>{{ $errors->first('captcha') }}</em>
							</li>
						@endif
						<li class="last">
							<input type="submit" class="pull-right btn btn-large btn-primary" value="登陆">
							<label><input type="checkbox" value="1" name="net_auto_login">记住我</label>
							<a href="{{ url('/reset') }}">忘记密码？</a>
						</li>
					</ul>
				</form>
			</div>
			<div class="side-bar pull-left">
				<h3>第三方账号登录</h3>
				<a href="" class="btn btn-block btn-weibo"><i class="icon icon-weibo"></i> 微博登录</a>
				<a href="{{ url('/qqlogin') }}" class="btn btn-block btn-qq"><i class="icon icon-qq"></i> QQ 登录</a>
				<a href="" class="btn btn-block btn-wechat">
					<i class="icon icon-wechat"></i> 微信扫一扫登录
					<div class="img">
						<img src="">
					</div>
				</a>
			</div>
		</div>
		<div class="mod-footer">
			<span>还没有账号?</span>&nbsp;&nbsp;
			<a href="{{ url('/register') }}">立即注册</a>&nbsp;&nbsp;
		</div>
	</div>
</div>
<script type="text/javascript" src="{{ asset('ask/login_files/login.js') }}"></script>
    <div class="aw-footer-wrap">
        <div class="aw-footer">
            Copyright © 2018, All Rights Reserved
            <span class="hidden-xs">Powered By <a href="http://www.soumore.cn" target="blank">Soumore</a></span>
        </div>
    </div>
<script>
function re_captcha() {
    $url = "{{ url('/captcha') }}";
    $url = $url + "/" + Math.random();
    document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
}
</script>
</body>
</html>