<!DOCTYPE html>
<html >
<head>
<title>Soumore</title>
<link rel="stylesheet" type="text/css" href="{{ asset('ask/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ask/css/icon.css') }}">
<link href="{{ asset('ask/css/common.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/css/link.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/css/style.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/css/register.css') }}" rel="stylesheet" type="text/css">
<script src="{{ asset('ask/js/jquery.2.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/js/jquery.form.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/js/plug-in_module.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/js/aws.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('ask/js/compatibility.js') }}"></script>
<body screen_capture_injected="true">
<div class="aw-register-box">
    <div class="mod-head">
        <h1>忘记密码</h1>
    </div>
    <div class="mod-body">
        <form class="aw-register-form" action="{{ url('/reset') }}"  method="post" id="register">
            {{ csrf_field() }}
            <ul>
                <li  class="aw-register-verify">
                    <a class=" btn btn-default btn-blue pull-right"  id="second" style="background-color:#66B7FF;color:white;">　　　发送　　　</a>
                    <input class="form-control" type="text"  id="email" name="email" value="{{ old('email') }}" placeholder="邮箱" >
                </li>

                <li >
                    <input type="text" name="captcha" value="{{ old('captcha') }}" placeholder="邮箱验证码" class="form-control">
                </li>
                @if ($errors->has('captcha'))
                    <li class="alert alert-danger error_message">
                        <i class="icon icon-delete"></i>
                        <em>
                            {{ $errors->first('captcha') }}
                        </em>
                    </li>
                @endif

                <li>
                    <input type="password" name="password" value="{{ old('password') }}" id="password" placeholder="密码" class="aw-register-pwd form-control">
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
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="重复密码" class="aw-register-pwd form-control">
                </li>
                @if ($errors->has('password_confirmation'))
                    <li class="alert alert-danger error_message">
                        <i class="icon icon-delete"></i>
                        <em>
                            {{ $errors->first('password_confirmation') }}
                        </em>
                    </li>
                @endif

                <li class="clearfix">
                    <button type="submit" class="btn btn-large btn-blue btn-block">提交</button>
                </li>
            </ul>
        </form>
    </div>
    <div class="mod-footer">
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
<!-- 弹层 -->
<script src="{{ asset('ask/layer/layer.js') }}"></script>
<script src="{{ asset('ask/common/js/jquery.cookie.js') }}"></script>
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
            $.post("{{ url('/email/resetCaptcha') }}",
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
            obj.text("　　　发送　　　");
            return;
        }else{
            obj.attr("disabled",true);
            obj.text("　　　"+countdown+ "秒　　　");
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
</script>
</body>
</html>