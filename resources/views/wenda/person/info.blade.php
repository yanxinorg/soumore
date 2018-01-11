@extends('layouts.wenda')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('wenda/bootstrap-datepicker/css/datepicker-custom.css') }}">
        <div class="wrapper">
          <div class="directory-info-row">
           @component('wenda.slot.account_show')@endcomponent
            <div class="col-md-9 col-sm-9">
                <section class="mail-box-info">
                    <header class="header">
                        <div class="compose-btn pull-left">
                            <a href="{{ url('/person/info') }}"><button class="btn btn-sm btn-success">个人资料</button></a>
                            <a href="{{ url('/person/thumb') }}"><button class="btn btn-sm btn-default">修改头像</button></a>
                            <a href="{{ url('/person/pass') }}"><button class="btn btn-sm btn-default">修改密码</button></a>
                        </div>
                        <div class="btn-toolbar">
                            <h4 class="pull-right"></h4>
                        </div>
                    </header>
                    <section class="mail-list" style="height:auto;">
                        <form class="form-horizontal" method="post" action="{{ url('/person/info') }}">
                        {{ csrf_field() }}
                        	<div class="form-group" hidden>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="uid" value="{{ $userinfo->id }}">
                                </div>
                            </div>
                        	<div class="form-group">
                                <label  class="col-md-2 col-sm-2 control-label" >用户名</label>
                                <div class="col-md-6 col-sm-8">
                                    <input type="text" class="form-control" value="{{ $userinfo->name }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-2 col-sm-2 control-label">真实姓名</label>
                                <div class="col-md-6 col-sm-8">
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
                                <div class="col-md-6 col-sm-8">
                                    <input type="text" class="form-control" value="{{ $userinfo->mobile }}" name="mobile" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 control-label">生日</label>
                                <div class="col-md-6 col-sm-8" >
                                	<input class="form-control form-control-inline input-medium default-date-picker" name="birth" value="{{ $userinfo->birthday }}"/>
							     </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 control-label">个人主页</label>
                                <div class="col-md-6 col-sm-8">
                                    <input type="url" class="form-control"  name="url" value="{{ $userinfo->site }}" placeholder="http://www.soumore.cn">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 control-label">QQ</label>
                                <div class="col-md-6 col-sm-8">
                                    <input type="text" class="form-control" value="{{ $userinfo->qq }}" name="qq" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 control-label">微信号</label>
                                <div class="col-md-6 col-sm-8">
                                    <input type="text" class="form-control" value="{{ $userinfo->weixin }}" name="weixin" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 control-label">所在城市</label>
                                <div class="col-md-6 col-sm-8">
                                        <div class="input-group input-large " >
                                        	<span class="input-group-addon">省</span>
	                                            <select class="form-control" name="province" id="province" style="width:100%;">
		                                            @if(!empty($userinfo->province))
	                                            	 	@foreach($province as $p)
				                                     	<option value="{{ $p->id }}" @if($userinfo->province == $p->id) selected @endif >{{ $p->name }}</option>
				                                     	@endforeach()
				                                    @else
				                                    	<option>请选择省份</option>
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
				                                    	<option>请选择城市</option>
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
                                <div class="col-md-6 col-sm-8">
                                    <input type="text" class="form-control" value="{{ $userinfo->graduateschool }}" name="school" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 control-label">公司名称</label>
                                <div class="col-md-6 col-sm-8">
                                    <input type="text" class="form-control" value="{{ $userinfo->company }}" name="company" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 control-label">职业</label>
                                <div class="col-md-6 col-sm-8">
                                    <input type="text" class="form-control" value="{{ $userinfo->occupation }}" name="profession" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-2 control-label">个性签名</label>
                                <div class="col-md-6 col-sm-8">
                                	<textarea rows="4" class="form-control" name="signature" >{{ $userinfo->bio }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-sm-offset-2 col-md-6 col-sm-8">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                            </div>
                        </form>
                    </section>
                </section>
            </div>
            
          </div>
        </div>
@section('js')
@parent
<script src="{{ asset('wenda/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('wenda/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.js') }}" type="text/javascript"></script>
<script src="{{ asset('wenda/js/pickers-init.js') }}" type="text/javascript"></script>
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
