<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>laravel</title>
    @section('css')
    <link href="{{ asset('back/admin/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('back/admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{{ asset('back/admin/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <!-- Gritter -->
    <link href="{{ asset('back/admin/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
	<link href="{{ asset('back/admin/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('back/admin/css/style.css') }}" rel="stylesheet">
	<!-- Sweet Alert -->
	<link href="{{ asset('back/admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    @show	
</head>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                        <img style="width: 48px;" class="img-circle" src="{{ \Illuminate\Support\Facades\Auth::user()->avator }}" />
                         </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#"><span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ \Illuminate\Support\Facades\Auth::user()->name }}</strong></span> <span class="text-muted text-xs block">info<b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="{{ url('/logout') }}">登出</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>

                <!--  内容管理 -->
                <li>
                    <a href="index.html#"><i class="fa fa-edit"></i> <span class="nav-label">内容管理</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ url('/back/cate/list') }}">分类管理</a></li>
                        <li><a href="{{ url('/back/post/list') }}">文章管理</a></li>
                    </ul>
                </li>

                <!--  问答管理 -->
                <li>
                    <a href="index.html#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">问答管理</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ url('/back/question/list') }}">问答管理</a></li>
                    </ul>
                </li>

                <!--  话题管理 -->
                <li>
                    <a href="index.html#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">话题管理</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ url('/back/topic/list') }}">话题管理</a></li>
                    </ul>
                </li>

                    {{--会员管理--}}
                <li >
                    <a href="index.html"><i class="fa fa-users"></i> <span class="nav-label">用户管理</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('/back/user/list') }}"><span class="nav-label">用户</span></a></li>
                    </ul>
                </li>

                <!--  RBAC权限管理	 -->
                <li >
                    <a href="index.html#"><i class="fa fa-bars"></i> <span class="nav-label">权限管理</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('/back/role/list') }}"><span class="nav-label">角色</span></a></li>
                        <li><a href="{{ url('/back/permit/list') }}"><span class="nav-label">权限</span></a></li>
                    </ul>
                </li>

                <!--  其他设置 -->
                <li>
                    <a href="index.html#"><i class="fa fa-sitemap"></i> <span class="nav-label">其他设置</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{ url('/back/notice/list') }}">公告管理</a></li>
                        <li><a href="{{ url('/back/link/list') }}">链接管理</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="javascript:void(0);"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="{{ url('/logout') }}">
                            <i class="fa fa-sign-out"></i>登出
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        @yield('content')

    </div>
</div>
@section('js')
 <!-- Mainly scripts -->
    <script src="{{ asset('back/admin/js/jquery-2.1.1.js') }}"></script>
	<script src="{{ asset('back/admin/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('back/admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
	<script src="{{ asset('back/admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Flot -->
    <script src="{{ asset('back/admin/js/plugins/flot/jquery.flot.js') }}"></script>
	<script src="{{ asset('back/admin/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
	<script src="{{ asset('back/admin/js/plugins/flot/jquery.flot.spline.js') }}"></script>
	<script src="{{ asset('back/admin/js/plugins/flot/jquery.flot.resize.js') }}"></script>
	<script src="{{ asset('back/admin/js/plugins/flot/jquery.flot.pie.js') }}"></script>

    <!-- Peity -->
	<script src="{{ asset('back/admin/js/plugins/peity/jquery.peity.min.js') }}"></script>
	<script src="{{ asset('back/admin/js/demo/peity-demo.js') }}"></script>
	
    <!-- Custom and plugin javascript -->
    <script src="{{ asset('back/admin/js/inspinia.js') }}"></script>
	<script src="{{ asset('back/admin/js/plugins/pace/pace.min.js') }}"></script>
	
    <!-- jQuery UI -->
    <script src="{{ asset('back/admin/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- GITTER -->
    <script src="{{ asset('back/admin/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('back/admin/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{ asset('back/admin/js/demo/sparkline-demo.js') }}"></script>

    <!-- ChartJS-->
    <script src="{{ asset('back/admin/js/plugins/chartJs/Chart.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ asset('back/admin/js/plugins/toastr/toastr.min.js') }}"></script>
    
    <!-- Sweet alert -->
<script src="{{ asset('back/admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

 <!-- Pjax -->
<script type="text/javascript" src="{{ URL::asset('/back/admin/js/jquery.pjax.js') }}"></script>
@show
</body>
</html>
