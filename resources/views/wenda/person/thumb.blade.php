@extends('layouts.wenda')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('wenda/avator/css/jquery.filer.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('wenda/avator/css/jquery.filer-dragdropbox-theme.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('wenda/avator/css/custom.css') }}">
    <div class="wrapper">
     <div class="directory-info-row">
            @component('wenda.slot.account_show')
            @endcomponent
            <div class="col-md-8">
	            	<section class="mail-box-info">
	            		<header class="header">
	                        <div class="compose-btn pull-left">
	                            <a href="{{ url('/person/info') }}"><button class="btn btn-default btn-sm">个人资料</button></a>
	                            <a href="{{ url('/person/thumb') }}"><button class="btn btn-sm btn-success">修改头像</button></a>
	                            <a href="{{ url('/person/pass') }}"><button class="btn btn-sm btn-default">修改密码</button></a>
	                        </div>
	                        <div class="btn-toolbar">
	                            <h4 class="pull-right"></h4>
	                        </div>
	                    </header>
	                    <section class="mail-list">
	                     	@if ($errors->has('thumb.0'))
					            <div class="alert-danger " style="text-align:center;margin-bottom:12px;">
					                 {{ $errors->first('thumb.0') }}
					            </div>
							@endif
					   		 <form action="{{ url('/person/thumb') }}" method="post" enctype="multipart/form-data" class="text-center">
                                   {{ csrf_field() }}
                                  <input type="file" name="thumb" id="demo-fileInput-4" multiple>
                                  <input type="submit" class="btn-custom green" value="提交">
                             </form>
	               		</section>
	            </section>
    		</div>
            <div class="col-md-2">
           
           </div>
     </div>
    </div>
@section('js')
@parent
<script src="{{ asset('wenda/avator/js/jquery.filer.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('wenda/avator/js/prettify.js') }}" type="text/javascript"></script>
<script src="{{ asset('wenda/avator/js/scripts.js') }}" type="text/javascript"></script>
<script src="{{ asset('wenda/avator/js/custom.js') }}" type="text/javascript"></script>
@stop
@endsection


