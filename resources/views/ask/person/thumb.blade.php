@extends('layouts.ask')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('ask/avator/css/jquery.filer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ask/avator/css/jquery.filer-dragdropbox-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ask/avator/css/custom.css') }}">
    <div class="aw-container-wrap">
        <div class="container1">
            <div class="row">
                <div class="aw-content-wrap clearfix">
                    <div class="col-sm-12 col-md-9 aw-main-content">

                        <a name="c_contents"></a>
                        <div class="aw-mod clearfix">
                            <div class="mod-head common-head">
                                <h2 id="main_title">更换头像</h2>
                            </div>

                            <div class="mod-body aw-feed-list clearfix" >
                                <div class="mod-head" style="padding-bottom: 48px;padding-top: 24px;">
                                    @if ($errors->has('success'))
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="alert alert-success ">
                                                    {{ $errors->first('success') }}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($errors->has('thumb.0'))
                                        <div class="col-md-12 col-sm-12">
                                            <div class="alert alert-danger " >
                                                {{ $errors->first('thumb.0') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div style="clear: both;"></div>
                                <form action="{{ url('/person/thumb') }}" method="post" enctype="multipart/form-data" class="text-center">
                                    {{ csrf_field() }}
                                    <input type="file" name="thumb" id="demo-fileInput-4" multiple>
                                    <input type="submit" class="btn-custom green" value="提交">
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- 侧边栏 -->
                    <div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm">

                        <div class="aw-mod side-nav">
                            <div class="mod-body">
                                <ul>
                                    <li><a href="{{ url('/person/info') }}" ><i class="icon icon-home"></i>基本资料</a></li>
                                    <li><a href="{{ url('/person/thumb') }}"  class="active" ><i class="icon icon-favor"></i>更换头像</a></li>
                                    <li><a href="{{ url('/person/pass') }}"><i class="icon icon-mytopic"></i>密码修改</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- 可能感兴趣的人/或话题 -->
                        <div class="aw-mod interest-user">
                            <div class="mod-head"><h3>可能感兴趣的人或话题</h3></div>
                            <div class="mod-body">
                                <dl>
                                    <dt class="pull-left aw-border-radius-5">
                                        <a href="http://ask.com/?/people/admin" data-id="4" class="aw-user-name"><img alt="admin" src="./动态 - WeCenter_files/avatar-min-img.png"></a>
                                    </dt>
                                    <dd class="pull-left">
                                        <a href="http://ask.com/?/people/admin" data-id="4" class="aw-user-name"><span>admin</span></a>
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick="AWS.User.follow($(this), &#39;user&#39;, 4);AWS.ajax_request(G_BASE_URL + &#39;/account/ajax/clean_user_recommend_cache/&#39;);"></a>
                                        <p class="signature"></p>
                                        <p></p>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt class="pull-left aw-border-radius-5">
                                        <a href="http://ask.com/?/people/admin" data-id="2" class="aw-user-name"><img alt="admin" src="./动态 - WeCenter_files/avatar-min-img.png"></a>
                                    </dt>
                                    <dd class="pull-left">
                                        <a href="http://ask.com/?/people/admin" data-id="2" class="aw-user-name"><span>admin</span></a>
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick="AWS.User.follow($(this), &#39;user&#39;, 2);AWS.ajax_request(G_BASE_URL + &#39;/account/ajax/clean_user_recommend_cache/&#39;);"></a>
                                        <p class="signature"></p>
                                        <p></p>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt class="pull-left aw-border-radius-5">
                                        <a href="http://ask.com/?/people/admin" data-id="3" class="aw-user-name"><img alt="admin" src="./动态 - WeCenter_files/avatar-min-img.png"></a>
                                    </dt>
                                    <dd class="pull-left">
                                        <a href="http://ask.com/?/people/admin" data-id="3" class="aw-user-name"><span>admin</span></a>
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick="AWS.User.follow($(this), &#39;user&#39;, 3);AWS.ajax_request(G_BASE_URL + &#39;/account/ajax/clean_user_recommend_cache/&#39;);"></a>
                                        <p class="signature"></p>
                                        <p></p>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt class="pull-left aw-border-radius-5">
                                        <a href="http://ask.com/?/topic/%E9%BB%98%E8%AE%A4%E8%AF%9D%E9%A2%98"><img alt="默认话题" src="./动态 - WeCenter_files/topic-mid-img.png"></a>
                                    </dt>
                                    <dd class="pull-left">
                                        <span class="topic-tag">
                                            <a href="http://ask.com/?/topic/%E9%BB%98%E8%AE%A4%E8%AF%9D%E9%A2%98" class="text">默认话题</a>
                                        </span>&nbsp;
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick="AWS.User.follow($(this), &#39;topic&#39;, 1);AWS.ajax_request(G_BASE_URL + &#39;/account/ajax/clean_user_recommend_cache/&#39;);"></a>
                                        <p></p>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <!-- end 侧边栏 -->
                </div>
            </div>
        </div>
    </div>
@section('js')
    @parent
    <script src="{{ asset('ask/avator/js/jquery.filer.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('ask/avator/js/prettify.js') }}" type="text/javascript"></script>
    <script src="{{ asset('ask/avator/js/scripts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('ask/avator/js/custom.js') }}" type="text/javascript"></script>
@stop
@endsection