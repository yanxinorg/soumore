<!DOCTYPE html>
<html>
<head>
<title>发现</title>
@section('css')
<link  href="{{ asset('ask/css/bootstrap.css') }}" rel="stylesheet" type="text/css" >
<link  href="{{ asset('ask/css/icon.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('ask/css/common.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/css/link.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('ask/css/style.css') }}" rel="stylesheet" type="text/css">
@show
@section('js')
<script src="{{ asset('ask/js/jquery.2.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/js/jquery.form.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/js/plug-in_module.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('ask/js/compatibility.js') }}"></script>
@show
<style>
    .container1{
        width: 66%;
        margin: 0 auto;
    }
    .container{
        margin: 0 auto;
        width: 66%;
        padding-right: 0px;
        padding-left: 0px;
    }
    .navbar-collapse
    {
        padding-left: 0px;
        padding-right: 15px;
    }
	 img{
		 max-width: 100%;
	 }
    .aw-footer {
         text-align: left;
    }
</style>
<body>
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
                            <li><a href="{{ url('/index') }}" class="{{ (Request::getPathinfo() == '/index')  ? 'active':'' }}"><i class="icon icon-about"></i>首页</a></li>
                            <li><a href="{{ url('/post') }}" class="{{ (Request::getPathinfo() == '/post')  ? 'active':'' }}"><i class="icon icon-file"></i>发现</a></li>
                            <li><a href="{{ url('/question') }}" class="{{ (Request::getPathinfo() == '/question')  ? 'active':'' }}"><i class="icon icon-help"></i>问答</a></li>
                            <li><a href="{{ url('/topic') }}" class="{{ (Request::getPathinfo() == '/topic')  ? 'active':'' }}"><i class="icon icon-topic"></i>话题</a></li>
                            <li><a href="{{ url('/video') }}" class="{{ (Request::getPathinfo() == '/video')  ? 'active':'' }}"><i class="icon icon-video"></i>视频</a></li>
                            <li><a href="{{ url('/dynamic') }}" class="{{ (Request::getPathinfo() == '/dynamic')  ? 'active':'' }}"><i class="icon icon-home"></i>动态</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- end 导航 -->

                    <!-- 搜索框 -->
                    <div class="aw-search-box  hidden-xs hidden-sm">
                        <form class="navbar-search" action="{{ url('/search/index') }}" method="post">
                            {{ csrf_field() }}
                            @if(!empty($wd))
                                <input class="form-control search-query" type="text" placeholder="搜索问题、话题、用户" autocomplete="off" name="wd" value="{{ $wd }}">
                            @else
                                <input class="form-control search-query" type="text" placeholder="搜索问题、话题、用户" autocomplete="off" name="wd" >
                            @endif
                        </form>
                    </div>
                    <!-- end 搜索框 -->

					<!-- 用户栏 -->
					<div class="aw-user-nav">
						<!-- 登陆&注册栏 -->
						<a href="{{ URL::action('Front\HomeController@index', ['uid'=>Auth::id()]) }}" class="aw-user-nav-dropdown">
                            @if(!empty($thumb))
							    <img src="{{ $thumb[0] }}-sm_thumb_small" onerror="this.src='{{ asset('ask/img/default_avator.jpg') }}'" >
                                @else
                                <img src="">
                            @endif
							@if(!empty($countNotice))
								<span class="badge badge-important">{{ $countNotice }}</span>
							@endif
						</a>
						<div class="aw-dropdown dropdown-list pull-right">
							<ul class="aw-dropdown-list">
								<li><a href="{{ url('/person/letter') }}"><i class="icon icon-inbox"></i> 私信
										@if(!empty($countNotice))
											<span class="badge badge-important collapse">{{ $countNotice }}</span>
										@endif
									</a>
								</li>
								<li class="hidden-xs"><a href="{{ url('/person/info') }}"><i class="icon icon-setting"></i> 设置</a></li>
								@role('admins')
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
								@role('admins')
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
                            <li><a href="{{ url('/index') }}" class="{{ (Request::getPathinfo() == '/index')  ? 'active':'' }}"><i class="icon icon-about"></i>首页</a></li>
							<li><a href="{{ url('/post') }}" class="{{ (Request::getPathinfo() == '/post')  ? 'active':'' }}"><i class="icon icon-file"></i> 发现</a></li>
							<li><a href="{{ url('/question') }}" class="{{ (Request::getPathinfo() == '/question')  ? 'active':'' }}"><i class="icon icon-help"></i>问答</a></li>
							<li><a href="{{ url('/topic') }}" class="{{ (Request::getPathinfo() == '/topic')  ? 'active':'' }}"><i class="icon icon-topic"></i> 话题</a></li>
                            <li><a href="{{ url('/video') }}" class="{{ (Request::getPathinfo() == '/video')  ? 'active':'' }}"><i class="icon icon-video"></i>视频</a></li>
						</ul>
					</nav>
				</div>
				<!-- end 导航 -->

                <!-- 搜索框 -->
                <div class="aw-search-box  hidden-xs hidden-sm">
                    <form class="navbar-search" action="{{ url('/search/index') }}" method="post" >
                        {{ csrf_field() }}
                        @if(!empty($wd))
                            <input class="form-control search-query" type="text" placeholder="搜索问题、话题、用户" autocomplete="off" name="wd" value="{{ $wd }}">
                        @else
                            <input class="form-control search-query" type="text" placeholder="搜索问题、话题、用户" autocomplete="off" name="wd" >
                        @endif
                        <span title="搜索" id="global_search_btns"><i class="icon icon-search"></i></span>
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

    <div class="aw-footer-wrap" style="background-color: white;color:black;margin-top: 24px;">
        <div class="aw-footer">
            <div class="container1" >
				<div class="row">
					<div class="col-md-3">
						<p>QQ群①：627375769 </p>
						<p>QQ群①：627375769 </p>
					</div>
					<div class="col-md-3">
						<p>QQ群①：627375769 </p>
					</div>
					<div class="col-md-3">
						<p>QQ群①：627375769 </p>
					</div>
					<div class="col-md-3">
						<p>QQ群①：627375769 </p>
					</div>
				</div>
				<p><a href="http://www.miitbeian.gov.cn" target="blank">苏ICP备15023456号-2</a></p>
            </div>
        </div>
    </div>
</body>
</html>