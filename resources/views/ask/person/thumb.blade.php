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
                            <div class="row">
                                <div class="col-md-6" style="border-right: 1px solid #E6E6E6; text-align: center" >
                                    <img src="{{ $thumbSrc }}" style="width: 60%;margin: 48px;" onerror="this.src='{{ asset('ask/img/default_avator.jpg') }}'">
                                </div>
                                <div class="col-md-6">
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
                                            <input type="file" name="thumb" id="demo-fileInput-6" multiple >
                                            <input type="submit" class="btn-custom green" value="提交">
                                        </form>
                                    </div>
                                </div>
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