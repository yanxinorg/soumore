<!DOCTYPE html>
<!-- saved from url=(0031)http://ask.com/?/account/login/ -->
<html class=""><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
<meta name="renderer" content="webkit">
<title>登录Soumores</title>
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
						<li>
							<input type="text" id="aw-login-user-name" class="form-control" placeholder="邮箱 /用户名" name="nameoremail" value="{{ old('nameoremail') }}">
						</li>
						
						<li>
							<input type="password" id="aw-login-user-password" class="form-control" placeholder="密码" name="password" value="{{ old('password') }}" >
						</li>
							@if ($errors->has('nameoremail'))
                                <li class="alert alert-danger error_message">
        							<i class="icon icon-delete"></i>
        							<em>
                                     {{ $errors->first('nameoremail') }}
                                    </em>
    							</li>
                     		@endif
                     		@if ($errors->has('password'))
                             <li class="alert alert-danger error_message">
								<i class="icon icon-delete"></i>
								<em>
                                 {{ $errors->first('password') }}
                              	</em>
							</li>
                         	@endif
                             	
						<li class="last">
							<input type="submit" class="pull-right btn btn-large btn-primary" value="登陆">
							<label>
								<input type="checkbox" value="1" name="net_auto_login">
								记住我							</label>
							<a href="">&nbsp;&nbsp;忘记密码</a>
						</li>
					</ul>
				</form>
    
    
			</div>
			<div class="side-bar pull-left"></div>
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
<a class="aw-back-top hidden-xs" href="javascript:;" onclick="$.scrollTo(1, 600, {queue:true});"><i class="icon icon-up"></i></a>
<div id="aw-ajax-box" class="aw-ajax-box"></div>

<div style="display:none;" id="__crond"><img src="{{ asset('ask/login_files/saved_resource') }}" width="1" height="1"></div>
</body></html>