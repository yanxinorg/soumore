@extends('layouts.ask')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('ask/avator/css/jquery.filer.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ask/avator/css/jquery.filer-dragdropbox-theme.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ask/avator/css/custom.css') }}">
    <div class="aw-container-wrap">
        <div class="container">
            <div class="row">
                <div class="aw-content-wrap clearfix">
                    <div class="aw-user-setting">
                        <div class="tabbable">
                            <ul class="nav nav-tabs aw-nav-tabs active">
                                <li><a href="{{ url('/person/pass') }}">安全设置</a></li>
                                <li class="active"><a href="{{ url('/person/thumb') }}">头像上传</a></li>
                                <li ><a href="{{ url('/person/info') }}">基本资料</a></li>
                            </ul>
                        </div>
                        <div class="tab-content clearfix">
                            <!-- 头像上传 -->
                            <div class="aw-mod">
                                <div class="mod-body">
                                    <div class="aw-mod aw-user-setting-bind">
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
                        </div>
                    </div>
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