@extends('layouts.ask')
@section('content')
<link  rel="stylesheet" type="text/css" href="{{ asset('ask/person_setting/user-setting.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ask/bootstrap-datepicker/css/datepicker-custom.css') }}">
    <div class="aw-container-wrap">
        <div class="container1">
            <div class="row">
                <div class="aw-content-wrap clearfix">
                    <div class="col-sm-12 col-md-9 aw-main-content">
                        <div class="aw-mod clearfix">
                            <div class="mod-head common-head">
                                <h2>基本资料</h2>
                            </div>
                            <div class="mod-body">
                                <div class="row" style="margin-top: 24px;">
                                    <div class="col-md-8 col-md-offset-2">
                                        <form class="form-horizontal" method="post" action="{{ url('/person/info') }}">
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
                                                <label  class="col-md-3 col-sm-2 control-label" >用户名</label>
                                                <div class="col-md-9 col-sm-10">
                                                    <input type="text" class="form-control" value="{{ $userinfo->name }}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label  class="col-md-3 col-sm-2 control-label">真实姓名</label>
                                                <div class="col-md-9 col-sm-10">
                                                    <input type="text" class="form-control" value="{{ $userinfo->realname }}" name="realname">
                                                </div>
                                            </div>
                                            @if ($errors->has('realname'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('realname') }}
                                                    </em>
                                                </li>
                                            @endif
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-2 control-label">邮箱</label>
                                                <div class="col-md-9 col-sm-8">
                                                    <input type="email" class="form-control" value="{{ $userinfo->email }}" name="email" >
                                                </div>
                                            </div>
                                            @if ($errors->has('email'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('email') }}
                                                    </em>
                                                </li>
                                            @endif
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-2 control-label">手机号</label>
                                                <div class="col-md-9 col-sm-10">
                                                    <input type="text" class="form-control" value="{{ $userinfo->mobile }}" name="mobile" >
                                                </div>
                                            </div>
                                            @if ($errors->has('mobile'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('mobile') }}
                                                    </em>
                                                </li>
                                            @endif
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-2 control-label">生日</label>
                                                <div class="col-md-9 col-sm-10" >
                                                    <input class="form-control form-control-inline input-medium default-date-picker" name="birth" value="{{ $userinfo->birthday }}"/>
                                                </div>
                                            </div>
                                            @if ($errors->has('birth'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('birth') }}
                                                    </em>
                                                </li>
                                            @endif
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-2 control-label">个人主页</label>
                                                <div class="col-md-9 col-sm-10">
                                                    <input type="url" class="form-control"  name="url" value="{{ $userinfo->site }}" placeholder="http://www.soumore.cn">
                                                </div>
                                            </div>
                                            @if ($errors->has('url'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('url') }}
                                                    </em>
                                                </li>
                                            @endif
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-2 control-label">QQ</label>
                                                <div class="col-md-9 col-sm-10">
                                                    <input type="text" class="form-control" value="{{ $userinfo->qq }}" name="qq" >
                                                </div>
                                            </div>
                                            @if ($errors->has('qq'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('qq') }}
                                                    </em>
                                                </li>
                                            @endif
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-2 control-label">微信号</label>
                                                <div class="col-md-9 col-sm-10">
                                                    <input type="text" class="form-control" value="{{ $userinfo->weixin }}" name="weixin" >
                                                </div>
                                            </div>
                                            @if ($errors->has('weixin'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('weixin') }}
                                                    </em>
                                                </li>
                                            @endif
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-2 control-label">所在城市</label>
                                                <div class="col-md-9 col-sm-10">
                                                    <div class="input-group input-large " >
                                                        <span class="input-group-addon">省</span>
                                                        <select class="form-control" name="province" id="province" style="width:100%;">
                                                            @if(!empty($userinfo->province))
                                                                @foreach($province as $p)
                                                                    <option value="{{ $p->id }}" @if($userinfo->province == $p->id) selected @endif >{{ $p->name }}</option>
                                                                @endforeach()
                                                            @else
                                                                <option value="">请选择省份</option>
                                                                @foreach($province as $p)
                                                                    <option value="{{ $p->id }}" @if($userinfo->province == $p->id) selected @endif >{{ $p->name }}</option>
                                                                @endforeach()
                                                            @endif()
                                                        </select>
                                                        <span class="input-group-addon">市</span>
                                                        <select class="form-control" name="city" id="city" style="width:100%;">
                                                            @if(!empty($userinfo->city))
                                                                @foreach($city as $c)
                                                                    <option value="{{ $c->id }}" @if( $userinfo->city ==  $c->id) selected @endif >{{ $c->name }}</option>
                                                                @endforeach
                                                            @else
                                                                <option value="">请选择城市</option>
                                                                @foreach($city as $c)
                                                                    <option value="{{ $c->id }}" @if( $userinfo->city ==  $c->id) selected @endif >{{ $c->name }}</option>
                                                                @endforeach
                                                            @endif()
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($errors->has('province'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('province') }}
                                                    </em>
                                                </li>
                                            @endif
                                            @if ($errors->has('city'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('city') }}
                                                    </em>
                                                </li>
                                            @endif
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-2 control-label">毕业院校</label>
                                                <div class="col-md-9 col-sm-10">
                                                    <input type="text" class="form-control" value="{{ $userinfo->graduateschool }}" name="school" >
                                                </div>
                                            </div>
                                            @if ($errors->has('school'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('school') }}
                                                    </em>
                                                </li>
                                            @endif
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-2 control-label">公司名称</label>
                                                <div class="col-md-9 col-sm-10">
                                                    <input type="text" class="form-control" value="{{ $userinfo->company }}" name="company" >
                                                </div>
                                            </div>
                                            @if ($errors->has('company'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('company') }}
                                                    </em>
                                                </li>
                                            @endif
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-2 control-label">职业</label>
                                                <div class="col-md-9 col-sm-10">
                                                    <input type="text" class="form-control" value="{{ $userinfo->occupation }}" name="profession" >
                                                </div>
                                            </div>
                                            @if ($errors->has('profession'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('profession') }}
                                                    </em>
                                                </li>
                                            @endif
                                            <div class="form-group">
                                                <label class="col-md-3 col-sm-2 control-label">个性签名</label>
                                                <div class="col-md-9 col-sm-10">
                                                    <textarea rows="4" class="form-control" name="signature" >{{ $userinfo->bio }}</textarea>
                                                </div>
                                            </div>
                                            @if ($errors->has('signature'))
                                                <li class="alert alert-danger error_message">
                                                    <i class="icon icon-delete"></i>
                                                    <em>
                                                        {{ $errors->first('signature') }}
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
                                    <li><a href="{{ url('/person/info') }}"  class="active" ><i class="icon icon-home"></i>基本资料</a></li>
                                    <li><a href="{{ url('/person/thumb') }}" ><i class="icon icon-favor"></i>更换头像</a></li>
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
<script src="{{ asset('ask/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/js/pickers-init.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        /*加载省份城市*/
        $("#province").change(function(){
            var province_id = $(this).val();
            $("#city").load("{{ url('/common/loadCity') }}/"+province_id);
        });
    });
</script>
@stop
@endsection