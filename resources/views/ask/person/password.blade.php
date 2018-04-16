@extends('layouts.ask')
@section('content')
<link  rel="stylesheet" type="text/css" href="{{ asset('ask/person_setting/user-setting.css') }}">
<div class="aw-container-wrap">
    <div class="container">
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="aw-user-setting">
                    <div class="tabbable">
                        <ul class="nav nav-tabs aw-nav-tabs active">
                            <li class="active"><a href="{{ url('/person/pass') }}">安全设置</a></li>
                            <li><a href="{{ url('/person/thumb') }}">头像上传</a></li>
                            <li><a href="{{ url('/person/info') }}">基本资料</a></li>
                        </ul>
                    </div>
                    <div class="tab-content clearfix">
                        <div class="aw-mod">
                            <div class="mod-body">
                                <div class="aw-mod aw-user-setting-bind">
                                    <div class="mod-head">
                                        <h3>修改密码</h3>
                                    </div>
                                    <form class="form-horizontal" method="post" action="{{ url('/person/storepass') }}">
                                        @if ($errors->has('success'))
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="alert alert-success ">
                                                        {{ $errors->first('success') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        {{ csrf_field() }}
                                        <div class="mod-body">
                                            <div class="form-group">
                                                <label class="control-label" for="input-password-old">当前密码</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" name="old_password" value="{{ old('old_password') }}" class="form-control" >
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        @if ($errors->has('old_password'))
                                                            <div class="alert alert-danger ">
                                                                {{ $errors->first('old_password') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="input-password-new">新的密码</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="password" name="new_password" value="{{ old('new_password') }}" class="form-control" >
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        @if ($errors->has('new_password'))
                                                            <div class="alert alert-danger ">
                                                                {{ $errors->first('new_password') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="input-password-re-new">确认密码</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="password" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}"  class="form-control" >
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        @if ($errors->has('new_password_confirmation'))
                                                            <div class="alert alert-danger ">
                                                                {{ $errors->first('new_password_confirmation') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mod-footer clearfix">
                                            <input type="submit" class="btn btn-large btn-success pull-right" value="保存"/>
                                        </div>
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
@endsection