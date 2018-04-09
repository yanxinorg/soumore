<!DOCTYPE html>
<!-- saved from url=(0031)http://ask.com/?/account/login/ -->
<html class=""><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
<meta name="renderer" content="webkit">
<title>注册Soumores</title>
<link rel="stylesheet" type="text/css" href="{{ asset('ask/register_files/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ask/register_files/icon.css') }}">
<link href="{{ asset('ask/register_files/common.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/register_files/link.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/register_files/style.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/register_files/register.css') }}" rel="stylesheet" type="text/css">
<script src="{{ asset('ask/register_files/jquery.2.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/register_files/jquery.form.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/register_files/plug-in_module.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/register_files/aws.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/register_files/aw_template.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/register_files/app.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('ask/register_files/compatibility.js') }}"></script>
<body screen_capture_injected="true">
<div class="aw-register-box">
    <div class="mod-head">
        <a href="{{ url('/') }}"><img src="{{ asset('ask/register_files/login_logo.png') }}" ></a>
        <h1>注册新用户</h1>
    </div>
    <div class="mod-body">
        <form class="aw-register-form" action="" method="post" id="register_form">
            <ul>
                <li class="alert alert-danger collapse error_message text-left">
                    <i class="icon icon-delete"></i> <em></em>
                </li>
                
                <li>
                    <input class="aw-register-name form-control" type="text" name="user_name" placeholder="用户名" >
                </li>
                
                <li>
                	<input type="text"  id="email" name="email" value="{{ old('email') }}" placeholder="邮箱" class="sendInput form-control">
                  	<a class="sendEmail btn btn-primary" id="second" value="">发送</a>
<!--                     <input class="aw-register-email form-control" type="text" name="email" placeholder="邮箱"  > -->
                </li>
                
                <li class="aw-register-verify">
                    <img class="pull-right" id="captcha" src="..">
                    <input type="text" class="form-control" name="seccode_verify" placeholder="验证码">
                </li>
                
                <li>
                    <input class="aw-register-pwd form-control" type="password" name="password" placeholder="密码" >
                </li>
               
                <li>
                    <input class="aw-register-pwd form-control" type="password" name="repassword" placeholder="重复密码" >
                </li>
               
                <li class="clearfix">
                    <button class="btn btn-large btn-blue btn-block" onclick="AWS.ajax_post($(&#39;#register_form&#39;), AWS.ajax_processer, &#39;error_message&#39;); return false;">注册</button>
                </li>
            </ul>
        </form>
    </div>
    <div class="mod-footer">
    	<span>已有账号?</span>&nbsp;&nbsp;
		<a href="{{ url('/login') }}">立即登陆</a>&nbsp;&nbsp;
    </div>
</div>
<div class="aw-footer-wrap">
	<div class="aw-footer">
		Copyright © 2018, All Rights Reserved
		<span class="hidden-xs">Powered By <a href="http://www.soumore.cn/?copyright" target="blank">Soumore</a></span>
	</div>
</div>

<a class="aw-back-top hidden-xs" href="javascript:;" onclick="$.scrollTo(1, 600, {queue:true});"><i class="icon icon-up"></i></a>
<!-- DO NOT REMOVE -->
<div id="aw-ajax-box" class="aw-ajax-box"></div>
<div style="display:none;" id="__crond"><img src="./register_files/saved_resource(1)" width="1" height="1"></div>
<!-- Escape time: 0.033930063247681 --><!-- / DO NOT REMOVE -->
</body></html>