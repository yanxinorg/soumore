<!DOCTYPE html>
<html class=""><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
<meta name="renderer" content="webkit">
<title>发现</title>
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('ask/index_files/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ask/index_files/icon.css') }}">
<link href="{{ asset('ask/index_files/common.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/index_files/link.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/index_files/style.css') }}" rel="stylesheet" type="text/css">
@show
@section('js')
<script src="{{ asset('ask/index_files/jquery.2.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/index_files/jquery.form.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/index_files/plug-in_module.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('ask/index_files/compatibility.js') }}"></script>
@show
<style>
    .container1{
        width: 82%;
        margin: 0 auto;
    }
    .container{
        margin: 0 auto;
        width: 82%;
        padding-right: 0px;
        padding-left: 0px;
    }
    .navbar-collapse
    {
        padding-left: 0px;
        padding-right: 15px;
    }
</style>
<body screen_capture_injected="true">
	<div class="aw-top-menu-wrap">
		<div class="container" >
			@auth
				<!-- 导航 -->
					<div class="aw-top-nav navbar">
						<div class="navbar-header">
							<button class="navbar-toggle pull-left">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<nav role="navigation" class="collapse navbar-collapse bs-navbar-collapse">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="icon icon-about"></i>关于</a></li>
								<li><a href="" ><i class="icon icon-download"></i>下载</a></li>
                                <li><a href="" ><i class="icon icon-log"></i>文档</a></li>
								<li><a href="{{ url('/post') }}" class="{{ (Request::getPathinfo() == '/post')  ? 'active':'' }}"><i class="icon icon-file"></i>文章</a></li>
								<li><a href="{{ url('/question') }}" class="{{ (Request::getPathinfo() == '/question')  ? 'active':'' }}"><i class="icon icon-help"></i>问答</a></li>
								<li><a href="{{ url('/topic') }}" class="{{ (Request::getPathinfo() == '/topic')  ? 'active':'' }}"><i class="icon icon-topic"></i>话题</a></li>
                                <li><a href="{{ url('/video') }}"><i class="icon icon-video"></i>视频</a></li>
                                <li><a href=""><i class="icon icon-list"></i>作品</a></li>
                                <li><a href="{{ URL::action('Front\PersonController@post', ['status'=>'1']) }}" class="{{ (Request::getPathinfo() == '/person/post')  ? 'active':'' }}"><i class="icon icon-home"></i> 动态</a></li>
							</ul>
						</nav>
					</div>
					<!-- end 导航 -->

                    <!-- 搜索框 -->
                    <div class="aw-search-box  hidden-xs hidden-sm">
                        <form class="navbar-search" action="{{ url('/search/index') }}" method="post">
                            {{ csrf_field() }}
                            @if(!empty($wd))
                                <input class="form-control search-query" type="text" placeholder="搜索问题、话题或人" autocomplete="off" name="wd" value="{{ $wd }}">
                            @else
                                <input class="form-control search-query" type="text" placeholder="搜索问题、话题或人" autocomplete="off" name="wd" >
                            @endif
                        </form>
                    </div>
                    <!-- end 搜索框 -->

					<!-- 用户栏 -->
					<div class="aw-user-nav">
						<!-- 登陆&注册栏 -->
						<a href="{{ URL::action('Front\HomeController@index', ['uid'=>Auth::id()]) }}" class="aw-user-nav-dropdown">
                            @if(!empty($thumb))
							    <img src="{{ $thumb[0] }}-sm_thumb_small">
                                @else
                                <img src="">
                            @endif
						</a>
						<div class="aw-dropdown dropdown-list pull-right">
							<ul class="aw-dropdown-list">
								<li><a href=""><i class="icon icon-inbox"></i> 私信<span class="badge badge-important collapse" id="inbox_unread" style="display: none;">0</span></a></li>
								<li class="hidden-xs"><a href="{{ url('/person/info') }}"><i class="icon icon-setting"></i> 设置</a></li>
								@role('administrators')
								<li class="hidden-xs"><a href="{{ url('/back/panel') }}"><i class="icon icon-job"></i> 管理</a></li>
								@endrole
								<li><a href="{{  url('/logout') }}"><i class="icon icon-logout"></i> 退出</a></li>
							</ul>
						</div>
						<!-- end 登陆&注册栏 -->
					</div>
					<!-- end 用户栏 -->
					<!-- 发起 -->
					<div class="aw-publish-btn">
						<a id="header_publish" class="btn-primary" href="javascript:;" style="text-decoration: none;"><i class="icon icon-ask"></i>发起</a>
						<div class="dropdown-list pull-right">
							<ul>
								<li><a href="{{ url('/post/create') }}">文章</a></li>
								<li><a href="{{ url('/question/create') }}">问题</a></li>
								@role('admin')
								<li><a href="{{ url('/video/create') }}">视频</a></li>
								@endrole
							</ul>
						</div>
					</div>
					<!-- end 发起 -->
			@else
				<div class="aw-top-nav navbar">
					<div class="navbar-header">
						<button class="navbar-toggle pull-left">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<nav role="navigation" class="collapse navbar-collapse bs-navbar-collapse">
						<ul class="nav navbar-nav">
                            <li><a href=""><i class="icon icon-about"></i>关于</a></li>
                            <li><a href="" ><i class="icon icon-download"></i>下载</a></li>
                            <li><a href="" ><i class="icon icon-log"></i>文档</a></li>
							<li><a href="{{ url('/post') }}" class="{{ (Request::getPathinfo() == '/post')  ? 'active':'' }}"><i class="icon icon-file"></i> 文章</a></li>
							<li><a href="{{ url('/question') }}" class="{{ (Request::getPathinfo() == '/question')  ? 'active':'' }}"><i class="icon icon-help"></i>问答</a></li>
							<li><a href="{{ url('/topic') }}" class="{{ (Request::getPathinfo() == '/topic')  ? 'active':'' }}"><i class="icon icon-topic"></i> 话题</a></li>
                            <li><a href="{{ url('/video') }}"><i class="icon icon-video"></i>视频</a></li>
						</ul>
					</nav>
				</div>
				<!-- end 导航 -->

                <!-- 搜索框 -->
                <div class="aw-search-box  hidden-xs hidden-sm">
                    <form class="navbar-search" action="{{ url('/search/index') }}" method="post">
                        {{ csrf_field() }}
                        @if(!empty($wd))
                            <input class="form-control search-query" type="text" placeholder="搜索问题、话题或人" autocomplete="off" name="wd" value="{{ $wd }}">
                        @else
                            <input class="form-control search-query" type="text" placeholder="搜索问题、话题或人" autocomplete="off" name="wd" >
                        @endif
                    </form>
                </div>
                <!-- end 搜索框 -->
				<!-- 用户栏 -->
				<div class="aw-user-nav">
					<!-- 登陆&注册栏 -->
					<a class="login btn btn-normal btn-primary" href="{{ url('/login') }}">登录</a>
					<a class="register btn btn-normal btn-success" href="{{ url('/register') }}">注册</a>								<!-- end 登陆&注册栏 -->
				</div>
			@endauth
		</div>
	</div>

	@yield('content')
	
    <div class="aw-footer-wrap">
    	<div class="aw-footer">Copyright © 2018, All Rights Reserved
    		<span class="hidden-xs">Powered By <a href="http://www.soumore.cn/?copyright" target="blank">Soumore</a></span>
    	</div>
    </div>
    <a class="aw-back-top hidden-xs" href="javascript:;" onclick="$.scrollTo(1, 600, {queue:true});"><i class="icon icon-up"></i></a>
    <!-- DO NOT REMOVE -->
    <div id="aw-ajax-box" class="aw-ajax-box"></div>
    <div style="display:none;" id="__crond"><img src="{{ asset('ask/index_files/saved_resource') }}" width="1" height="1"></div>


</body>
</html>