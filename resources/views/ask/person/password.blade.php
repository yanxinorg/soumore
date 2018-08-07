@extends('layouts.ask')
@section('content')
    <div class="aw-container-wrap">
        <div class="container1">
            <div class="row">
                <div class="aw-content-wrap clearfix">
                    <div class="col-sm-12 col-md-9 aw-main-content">
                        <div class="aw-mod clearfix">
                            <div class="mod-head common-head">
                                <h2>修改密码</h2>
                            </div>
                            <div class="mod-body">
                                <div class="row" style="margin-top: 24px;">
                                    <div class="col-md-8 col-md-offset-2">
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
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-2 control-label">当前密码</label>
                                                <div class="col-md-9 col-sm-8">
                                                    <input type="password" class="form-control" value="{{ old('old_password') }}" name="old_password" >
                                                </div>
                                            </div>
                                            @if ($errors->has('old_password'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('old_password') }}
                                                    </em>
                                                </li>
                                            @endif
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-2 control-label">新的密码</label>
                                                <div class="col-md-9 col-sm-10">
                                                    <input type="password" class="form-control" value="{{ old('new_password') }}" name="new_password" >
                                                </div>
                                            </div>
                                            @if ($errors->has('new_password'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('new_password') }}
                                                    </em>
                                                </li>
                                            @endif

                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-2 control-label">确认密码</label>
                                                <div class="col-md-9 col-sm-10">
                                                    <input type="password" class="form-control"  name="new_password_confirmation" value="{{ old('new_password_confirmation') }}" >
                                                </div>
                                            </div>
                                            @if ($errors->has('new_password_confirmation'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('new_password_confirmation') }}
                                                    </em>
                                                </li>
                                            @endif
                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-sm-offset-2 col-md-6 col-sm-10">
                                                    <button type="submit" class="btn btn-large btn-success pull-right">保存</button>
                                                </div>
                                            </div>
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
                                    <li><a href="{{ url('/person/thumb') }}"><i class="icon icon-favor"></i>更换头像</a></li>
                                    <li><a href="{{ url('/person/pass') }}"  class="active" ><i class="icon icon-mytopic"></i>密码修改</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end 侧边栏 -->
                </div>
            </div>
        </div>
    </div>
@endsection