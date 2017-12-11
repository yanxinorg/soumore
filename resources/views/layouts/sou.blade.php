<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{ config('app.name', 'soumore') }}</title>
  @section('css')
  <!-- Bootstrap -->
  <link href="{{ asset('wenda/common/css/stickup.css') }}" rel="stylesheet">
  <link href="{{ asset('wenda/common/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('wenda/common/css/flat-ui.css') }}" rel="stylesheet">
  @show
</head>
<body>
<style>
.main-content{
background-color:#F4F4F4;
}
</style>
<!-- 导航 -->
<div class="navbar-wrapper">
  <nav class="navbar-inverse"  role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <a class="navbar-brand active" href="{{ url('/sou') }}">SOUMORE</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse-01">
      <form action="##" class="navbar-form navbar-left">
          <div class="form-group">
          	@if(!empty($s))
          		<input type="text" class="form-control search" name="s" value="{{ $s }}" placeholder="请输入关键词" />
          	@else
          		<input type="text" class="form-control search" name="s" placeholder="请输入关键词" />
          	@endif
          </div>
          <button type="submit" class="btn btn-success">搜索</button>
      </form>
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