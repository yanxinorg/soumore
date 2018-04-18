@extends('layouts.ask')
@section('content')
<link  rel="stylesheet" type="text/css" href="{{ asset('ask/person_setting/user-setting.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ask/bootstrap-datepicker/css/datepicker-custom.css') }}">
<div class="aw-container-wrap">
    <div class="container">
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="aw-user-setting">
                    <div class="tabbable">
                        <ul class="nav nav-tabs aw-nav-tabs active">
                            <li><a href="{{ url('/person/pass') }}">密码修改</a></li>
                            <li><a href="{{ url('/person/thumb') }}">头像上传</a></li>
                            <li class="active"><a href="{{ url('/person/info') }}">基本资料</a></li>
                        </ul>
                    </div>

                    <div class="tab-content clearfix">
                        <!-- 基本信息 -->
                        <div class="aw-mod">
                            <div class="mod-body">
                                <div class="aw-mod mod-base">
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
                                            <label  class="col-md-2 col-sm-2 control-label" >用户名</label>
                                            <div class="col-md-6 col-sm-10">
                                                <input type="text" class="form-control" value="{{ $userinfo->name }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="col-md-2 col-sm-2 control-label">真实姓名</label>
                                            <div class="col-md-6 col-sm-10">
                                                <input type="text" class="form-control" value="{{ $userinfo->realname }}" name="realname">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-2 control-label">邮箱</label>
                                            <div class="col-md-6 col-sm-8">
                                                <input type="email" class="form-control" value="{{ $userinfo->email }}" name="email" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-2 control-label">手机号</label>
                                            <div class="col-md-6 col-sm-10">
                                                <input type="text" class="form-control" value="{{ $userinfo->mobile }}" name="mobile" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-2 control-label">生日</label>
                                            <div class="col-md-6 col-sm-10" >
                                                <input class="form-control form-control-inline input-medium default-date-picker" name="birth" value="{{ $userinfo->birthday }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-2 control-label">个人主页</label>
                                            <div class="col-md-6 col-sm-10">
                                                <input type="url" class="form-control"  name="url" value="{{ $userinfo->site }}" placeholder="http://www.soumore.cn">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-2 control-label">QQ</label>
                                            <div class="col-md-6 col-sm-10">
                                                <input type="text" class="form-control" value="{{ $userinfo->qq }}" name="qq" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-2 control-label">微信号</label>
                                            <div class="col-md-6 col-sm-10">
                                                <input type="text" class="form-control" value="{{ $userinfo->weixin }}" name="weixin" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-2 control-label">所在城市</label>
                                            <div class="col-md-6 col-sm-10">
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
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-2 control-label">毕业院校</label>
                                            <div class="col-md-6 col-sm-10">
                                                <input type="text" class="form-control" value="{{ $userinfo->graduateschool }}" name="school" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-2 control-label">公司名称</label>
                                            <div class="col-md-6 col-sm-10">
                                                <input type="text" class="form-control" value="{{ $userinfo->company }}" name="company" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-2 control-label">职业</label>
                                            <div class="col-md-6 col-sm-10">
                                                <input type="text" class="form-control" value="{{ $userinfo->occupation }}" name="profession" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-2 control-label">个性签名</label>
                                            <div class="col-md-6 col-sm-10">
                                                <textarea rows="4" class="form-control" name="signature" >{{ $userinfo->bio }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-offset-2 col-sm-offset-2 col-md-6 col-sm-10">
                                                <button type="submit" class="btn btn-large btn-success pull-right">保存</button>
                                            </div>
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