@extends('layouts.back')
@section('content')
<link href="{{ asset('back/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('back/css/style-responsive.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('back/css/bootstrap-fileupload.min.css') }}" />
<section class="wrapper ">
    <div class="row">
            <div class="col-lg-12 col-sm-12 ">
                <section class="panel">
    	            <header class="panel-heading">添加角色</header>
    	            <div class="panel-body">
    	                <form class="form-horizontal adminex-form" method="post" action="{{ url('/back/role/store') }}">
    	                {{ csrf_field() }}
    	                    <div class="form-group">
    	                        <label class="col-sm-2 col-sm-2 control-label"><span style="color: red;">*</span>角色标识</label>
    	                        <div class="col-sm-6 col-sm-6">
    	                            <input type="text" name="name" class="form-control" placeholder="例如:admin">
    	                        </div>
    	                          @if ($errors->has('name'))
    	                          <div class="col-sm-4 col-sm-4">
                                     <span style="color:red;">{{ $errors->first('name') }}</span>
    	                          </div>
                             	  @endif
    	                    </div>
    	                    <div class="form-group">
    	                        <label class="col-sm-2 col-sm-2 control-label"><span style="color: red;">*</span>显示名称</label>
    	                        <div class="col-sm-6 col-sm-6">
    	                            <input type="text" name="display_name" class="form-control" placeholder="例如:管理员">
    	                        </div>
    	                          @if ($errors->has('display_name'))
    	                          <div class="col-sm-4 col-sm-4">
                                     <span style="color:red;">{{ $errors->first('display_name') }}</span>
    	                          </div>
                             	  @endif
    	                    </div>
    	                    <div class="form-group">
    	                         <label class="col-sm-2 col-md-2 control-label">备注</label>
    	                        <div class="col-md-6 col-sm-6">
    	                            <textarea rows="6" class="form-control" name="description"></textarea>
    	                        </div>
    	                    </div>
    	                    <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                            </div>
    	                </form>
    	            </div>
            	</section>
            </div>
    </div>
</section>
@section('js')
@parent
<!--file upload-->
<script type="text/javascript" src="{{ URL::asset('back/js/bootstrap-fileupload.min.js') }}"></script>
@stop
@endsection
