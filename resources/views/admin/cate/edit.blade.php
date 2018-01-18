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
    	            <header class="panel-heading">编辑分类</header>
    	            <div class="panel-body">
    	                <form class="form-horizontal adminex-form" method="post" action="{{ url('/back/cate/store') }}" enctype="multipart/form-data">
    	                {{ csrf_field() }}
    	                    <div class="form-group">
    	                        <label class=" control-label col-lg-2 col-sm-2" for="inputSuccess"><span style="color: red;">*</span>父级分类</label>
    	                        <div class="col-lg-6 col-sm-6">
    	                             <select class="select2_single form-control" name="pid" tabindex="-1">
			                             <option value="0">顶级分类</option>
				                            @foreach($pids as $pid)
				                            	@if($pid->id == $cate->id )
				                                    <option  value="{{ $pid->id }}" selected>
				                                        @if( $pid->count != 0)
				                                            @for ($i=0;$i<$pid->count;$i++)
				                                            	@if( $i == 0)
				                								<span>|---</span>
				                								@else
				                								<span>---</span>
				                								@endif
				                                            @endfor
				                                        {{ $pid->name }}
				                                        @endif
				                                    </option>
				                                @else
				                                	 <option  value="{{ $pid->id }}" >
				                                        @if( $pid->count != 0)
				                                            @for ($i=0;$i<$pid->count;$i++)
				                                            	@if( $i == 0)
				                								<span>|---</span>
				                								@else
				                								<span>---</span>
				                								@endif
				                                            @endfor
				                                        {{ $pid->name }}
				                                        @endif
				                                    </option>
				                                 @endif
				                            @endforeach
			                          </select>
    	                        </div>
    	                         @if ($errors->has('pid'))
    	                          <div class="col-sm-4 col-sm-4">
                                     <span style="color:red;">{{ $errors->first('pid') }}</span>
    	                          </div>
                             	  @endif
    	                    </div>
    	                    <div class="form-group">
    	                        <label class="col-sm-2 col-sm-2 control-label"><span style="color: red;">*</span>分类名称</label>
    	                        <div class="col-sm-6 col-sm-6">
    	                            <input type="text" name="name" class="form-control" value="{{ $cate->name }}">
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
    	                        <label class="col-sm-2 col-md-2 control-label">分类描述</label>
    	                        <div class="col-md-6 col-sm-6">
    	                            <textarea rows="6" class="form-control" name="desc" >{{ $cate->desc }}</textarea>
    	                        </div>
    	                    </div>
    						<div class="form-group">
                                <label class="col-sm-2 control-label"><span style="color: red;">*</span>状态</label>
                                <div class="col-sm-10 icheck minimal">
                                    @if($cate->status == 1)
                					<div class="radio-inline ">
                                        <input type="radio"  name="status" value="1" checked>
                                        <label>启用</label>
                                    </div>
                                    <div class="radio-inline ">
                                        <input type="radio"  name="status" value="0" >
                                        <label>禁用</label>
                                    </div>
	                				@else
	                				<div class="radio-inline ">
                                        <input type="radio"  name="status" value="1" >
                                        <label>启用</label>
                                    </div>
                                    <div class="radio-inline ">
                                        <input type="radio"  name="status" value="0" checked>
                                        <label>禁用</label>
                                    </div>
	                				@endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">排序</label>
                                <div class="col-md-10">
                                    <div id="spinner1">
                                        <div class="input-group input-small">
                                            <input type="text" class="spinner-input form-control" name="order" maxlength="3" >
                                            <div class="spinner-buttons input-group-btn btn-group-vertical">
                                                <button type="button" class="btn spinner-up btn-xs btn-default">
                                                    <i class="fa fa-angle-up"></i>
                                                </button>
                                                <button type="button" class="btn spinner-down btn-xs btn-default">
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                            </div>
                                        </div>
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
