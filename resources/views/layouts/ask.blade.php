<!DOCTYPE html>
<html class=""><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
<meta name="renderer" content="webkit">
<title>发现</title>
<link rel="stylesheet" type="text/css" href="{{ asset('ask/index_files/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ask/index_files/icon.css') }}">
<link href="{{ asset('ask/index_files/common.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/index_files/link.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/index_files/style.css') }}" rel="stylesheet" type="text/css">
<script src="{{ asset('ask/index_files/jquery.2.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/index_files/jquery.form.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/index_files/plug-in_module.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/index_files/aws.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('ask/index_files/compatibility.js') }}"></script>
<body screen_capture_injected="true">
	<div class="aw-top-menu-wrap">
		<div class="container">
			<!-- logo -->
			<div class="aw-logo hidden-xs">
				<a href="{{ url('/') }}"></a>
			</div>
			<!-- end logo -->
			<!-- 搜索框 -->
			<div class="aw-search-box  hidden-xs hidden-sm">
				<form class="navbar-search" action="http://ask.com/?/search/" id="global_search_form" method="post">
					<input class="form-control search-query" type="text" placeholder="搜索问题、话题或人" autocomplete="off" name="q" id="aw-search-query">
					<span title="搜索" id="global_search_btns" onclick="$(&#39;#global_search_form&#39;).submit();"><i class="icon icon-search"></i></span>
					<div class="aw-dropdown">
						<div class="mod-body">
							<p class="title">输入关键字进行搜索</p>
							<ul class="aw-dropdown-list collapse"></ul>
							<p class="search"><span>搜索:</span><a onclick="$(&#39;#global_search_form&#39;).submit();"></a></p>
						</div>
						<div class="mod-footer">
							<a href="javascript:;" onclick="$(&#39;#header_publish&#39;).click();" class="pull-right btn btn-mini btn-success publish">发起问题</a>
						</div>
					</div>
				</form>
			</div>
			<!-- end 搜索框 -->
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
								<li><a href=""><i class="icon icon-home"></i> 动态</a></li>
								<li><a href="{{ url('/post') }}" class="{{ (Request::getPathinfo() == '/post')  ? 'active':'' }}"><i class="icon icon-list"></i> 发现</a></li>
								<li><a href="{{ url('/topic') }}" class="{{ (Request::getPathinfo() == '/topic')  ? 'active':'' }}"><i class="icon icon-topic"></i> 话题</a></li>
								<li>
									<a href="" class=""><i class="icon icon-bell"></i> 通知</a>
									<span class="badge badge-important" style="display:none" id="notifications_unread">0</span>
									<div class="aw-dropdown pull-right hidden-xs">
										<div class="mod-body">
											<ul id="header_notification_list"><p class="aw-padding10" align="center">没有未读通知</p></ul>
										</div>
										<div class="mod-footer">
											<a href="">查看全部</a>
										</div>
									</div>
								</li>
								<li>
									<a style="font-weight:bold;">· · ·</a>
									<div class="dropdown-list pull-right">
										<ul id="extensions-nav-list">
									</div>
								</li>
							</ul>
						</nav>
					</div>
					<!-- end 导航 -->
					<!-- 用户栏 -->
					<div class="aw-user-nav">
						<!-- 登陆&注册栏 -->
						<a href="{{ URL::action('Front\HomeController@index', ['uid'=>Auth::id()]) }}" class="aw-user-nav-dropdown">
							<img alt="{{ Auth::user()->name }}" src="{{ route('getThumbImg', Auth::user()->id) }}">
						</a>
						<div class="aw-dropdown dropdown-list pull-right">
							<ul class="aw-dropdown-list">
								<li><a href=""><i class="icon icon-inbox"></i> 私信<span class="badge badge-important collapse" id="inbox_unread" style="display: none;">0</span></a></li>
								<li class="hidden-xs"><a href=""><i class="icon icon-setting"></i> 设置</a></li>
								<li class="hidden-xs"><a href=""><i class="icon icon-job"></i> 管理</a></li>
								<li><a href="{{  url('/logout') }}"><i class="icon icon-logout"></i> 退出</a></li>
							</ul>
						</div>
						<!-- end 登陆&注册栏 -->
					</div>
					<!-- end 用户栏 -->
					<!-- 发起 -->
					<div class="aw-publish-btn">
						<a id="header_publish" class="btn-primary" href="javascript:void(0);"><i class="icon icon-ask"></i>发起</a>
						<div class="dropdown-list pull-right">
							<ul>
								<li>
									<form method="post" action="">
										<a >问题</a>
									</form>
								</li>
								<li>
									<form method="post" action="">
										<a >文章</a>
									</form>
								</li>
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
							<li><a href="{{ url('/post') }}" class="{{ (Request::getPathinfo() == '/post')  ? 'active':'' }}"><i class="icon icon-list"></i> 发现</a></li>
							<li><a href="{{ url('/topic') }}" class="{{ (Request::getPathinfo() == '/topic')  ? 'active':'' }}"><i class="icon icon-topic"></i> 话题</a></li>
							<li>
								<a style="font-weight:bold;">· · ·</a>
								<div class="dropdown-list pull-right">
									<ul id="extensions-nav-list">
									</ul>
								</div>
							</li>
						</ul>
					</nav>
				</div>
				<!-- end 导航 -->
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