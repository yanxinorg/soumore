@extends('layouts.back')
@section('content')
<link href="{{ asset('back/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('back/css/style-responsive.css') }}" rel="stylesheet">
<!--file upload-->
<link rel="stylesheet" type="text/css" href="{{ asset('back/css/bootstrap-fileupload.min.css') }}" />
<section class="wrapper ">
    <div class="row">
            <div class="col-lg-12 col-sm-12 ">
                <section class="panel">
    	            <header class="panel-heading">添加话题</header>
    	            <div class="panel-body">
    	                <form class="form-horizontal adminex-form" method="post" action="{{ url('/back/tag/store') }}" enctype="multipart/form-data">
    	                {{ csrf_field() }}
    	                    <div class="form-group">
    	                        <label class="col-sm-2 col-sm-2 control-label"><span style="color: red;">*</span>话题名称</label>
    	                        <div class="col-sm-6 col-sm-6">
    	                            <input type="text" name="name" class="form-control">
    	                        </div>
    	                          @if ($errors->has('name'))
    	                          <div class="col-sm-4 col-sm-4">
                                     <span style="color:red;">{{ $errors->first('name') }}</span>
    	                          </div>
                             	  @endif
    	                    </div>
    	                   
    						<div class="form-group last">
                                    <label class="control-label col-md-2"><span style="color: red;">*</span>缩略图</label>
                                    <div class="col-md-6">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                               <span class="btn btn-default btn-file" style="margin-left:1px;">
    	                                           <span class="fileupload-new">Select</span>
    	                                           <span class="fileupload-exists"><i class="fa fa-undo"></i>重置</span>
    	                                           <input type="file" name="thumb" class="default"/>
                                               </span>
                                               <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i>移除</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                          @if ($errors->has('thumb'))
                                             <span style="color:red;">{{ $errors->first('thumb') }}</span>
                                     	  @endif
                                    </div>
                            </div>
    	                    <div class="form-group">
    	                        <label class="col-sm-2 col-md-2 control-label"><span style="color: red;">*</span>话题描述</label>
    	                        <div class="col-md-6 col-sm-6">
    	                            <textarea rows="6" class="form-control" name="desc" ></textarea>
    	                        </div>
    	                    </div>
    						<div class="form-group">
                                <label class="col-sm-2 control-label"><span style="color: red;">*</span>状态</label>
                                <div class="col-sm-10 icheck minimal">
                                    <div class="radio-inline ">
                                        <input type="radio"  name="status" value="1" checked>
                                        <label>启用</label>
                                    </div>
                                    <div class="radio-inline ">
                                        <input type="radio"  name="status" value="0" >
                                        <label>禁用</label>
                                    </div>
                                </div>
                            </div>
                             @if ($errors->has('msg'))
                               <div class="form-group">
                                <div class="col-md-12">
                                   <span style="color:red;">{{ $errors->first('msg') }}</span>
                                </div>
                            </div>
                             @endif
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
<!--common scripts for all pages-->
<script type="text/javascript" src="{{ URL::asset('back/js/fuelux/js/spinner.min.js') }}"></script>
<script src="{{ URL::asset('back/js/spinner-init.js') }}"></script>
<!--file upload-->
<script type="text/javascript" src="{{ URL::asset('back/js/bootstrap-fileupload.min.js') }}"></script>

@stop
@endsection
