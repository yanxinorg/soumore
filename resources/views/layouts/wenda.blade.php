<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{ config('app.name', '问答系统') }}</title>
  @section('css')
	  <!-- Bootstrap -->
	  <link href="{{ asset('wenda/common/css/stickup.css') }}" rel="stylesheet">
	  <link href="{{ asset('wenda/common/css/style.css') }}" rel="stylesheet">
	  <link href="{{ asset('wenda/common/css/flat-ui.css') }}" rel="stylesheet">
  @show
</head>
<body>
<style>
html, body {
height: 100%;
}
.main-content{
background-color:#F4F4F4;
min-height:100%;
}
.navbar-wrapper{
z-index:9999;
}
.form-control{
	border:1px solid #bdc3c7
}
.footer {
	height: 250px;
	width:100%;
}
.footer_top {
	height: 200px;
	background-color: #34495E;
}
.footer_bottom {
	height: 50px;
	color:black;
	background-color: #293A4A;
	text-align:center;
}
.footer_bottom  p{
	line-height:50px;
}
.footer_bottom a{
	color:black;
}
</style>
<!-- 导航 -->
<div class="navbar-wrapper" >
  <nav class="navbar-inverse"  role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
<!--        <a class="navbar-brand active" href="{{ url('/sou') }}">soumore</a> -->
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse-01">
      <ul class="nav navbar-nav">
      	<li class="menuItem "><a href="{{ url('/about') }}">关于</a></li>
        <li class="menuItem "><a href="{{ url('/post') }}">文章</a></li>
        <li class="menuItem"><a href="{{ url('/question') }}">问答</a></li>
        <li class="menuItem "><a href="{{ url('/topic') }}">话题</a></li>
      </ul>
<!--       <form action="{{ url('/search') }}" method="post" class="navbar-form navbar-left" > -->
<!--       	{{ csrf_field() }} -->
<!--           <div class="form-group"> -->
<!--           	@if(!empty($wd)) -->
<!--           		<input type="text" class="form-control search" name="wd" value="{{ $wd }}" placeholder="请输入关键词" /> -->
<!--           	@else -->
<!--           		<input type="text" class="form-control search" name="wd" placeholder="请输入关键词" /> -->
<!--           	@endif -->
<!--           </div> -->
<!--           <button type="submit" class="form-control btn btn-success">搜索</button> -->
<!--       </form> -->
      <ul class="nav navbar-nav navbar-right" style="margin-right: 24px;">
       		@auth
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">{{ Auth::user()->name }}<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="{{ URL::action('Front\HomeController@index', ['uid'=>Auth::id()]) }}">个人主页</a>
                  </li>
                  <li>
                    <a href="{{ url('/person/info') }}">账户设置</a>
                  </li>
                  <li>
                    <a href="{{ url('/admin') }}">后台管理</a>
                  </li>
                  <li>
                    <a href="{{ url('/logout') }}">退出登录</a>
                  </li>
                </ul>
            </li>
            @else
                <li class="menuItem"><a href="{{ url('/login') }}">登录</a></li>
        		<li class="menuItem"><a href="{{ url('/register') }}">注册</a></li>
            @endauth
       
      </ul>
    </div>
  </nav>
</div>
<!-- 搜素内容 -->
<div class="main-content" >
	@yield('content')
</div>

<!-- 底部导航 -->
<div class="footer">
	<div class="footer_content">
	    <div class="footer_top">
	            
	    </div>
	    <div class="footer_bottom">
	        <p>soumore| <a href="http://www.miitbeian.gov.cn" target="_blank">苏ICP备15023456号-2</a></p>
	    </div>
	</div>
</div>
@section('js')
<!-- main content end-->
<script src="{{ asset('wenda/common/js/jquery.min.js') }}"></script>
<script src="{{ asset('wenda/common/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('wenda/common/js/stickUp.min.js') }}"></script>
<script type="text/javascript">
  jQuery(function($) {
    $(document).ready( function() {
      $('.navbar-wrapper').stickUp({
            itemHover: 'active',
            topMargin: 'auto'
        });
    });
  });
</script>
 @show
</body>
</html>