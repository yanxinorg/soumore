@extends('layouts.admin')
@section('content')
<link href="{{ asset('back/admin/css/plugins/chosen/chosen.css') }}" rel="stylesheet">
<link href="{{ asset('back/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
<link href="{{ asset('back/admin/css/fileinput.min.css') }} " rel="stylesheet" type="text/css" />
<link href="{{ asset('back/admin/css/style.css') }} " rel="stylesheet">
<div class="wrapper wrapper-content animated fadeInRight">
 <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="ibox-tools">
                               <div class="pull-right">
                                    <a type="button" class="btn btn-sm btn-white" href="{{ url('/back/user/list') }}"> <i class="fa fa-list">列表</i></a>
                               </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="{{ url('/back/user/store') }}" class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">名称</label>
                                    <div class="col-sm-6">
                                    	<input type="text" class="form-control" name="username">
                                    </div>
                                    <div class="col-sm-2">
	                              		 @if ($errors->has('username'))
	                              		 <span class="label label-danger">{{ $errors->first('username') }}</span>
								         @endif
	                              	</div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">邮箱</label>
                                    <div class="col-sm-6">
                                    	<input type="text" class="form-control"  name="email">
                                    </div>
                                    <div class="col-sm-2">
	                              		 @if ($errors->has('email'))
	                              		 <span class="label label-danger">{{ $errors->first('email') }}</span>
								         @endif
	                              	</div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">密码</label>
                                    <div class="col-sm-6">
                                    	<input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="col-sm-2">
	                              		 @if ($errors->has('password'))
	                              		 <span class="label label-danger">{{ $errors->first('password') }}</span>
								         @endif
	                              	</div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">头像</label>
                                    <div class="col-sm-6">
                                    	<input id="input-id" type="file" class="file" data-preview-file-type="text" name="avatar" >
                                    </div>
                                    <div class="col-sm-2 ">
	                              		 @if ($errors->has('avatar'))
	                              		 	<span class="label label-danger">{{ $errors->first('avatar') }}</span>
								         @else
								         	<span class="label label-success">图片2M以内</span>
								         @endif
                              		</div>
                                </div>
                                
			                   <div class="hr-line-dashed"></div>
			                   <div class="form-group">
			                		<label class="col-lg-2 control-label">角色</label>
				                	<div class=" col-lg-6">
					                	<select data-placeholder="Choose a Role..." class="chosen-select form-control" name="roles[]" multiple  tabindex="4">
							                @foreach($roles as $role )
							                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
							                @endforeach()
						                </select>
					                </div>
				                </div>
				                
				                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-lg-2 control-label">状态</label>
                                    <div class="col-lg-6">
                                    	<div class="radio radio-info radio-inline">
                                            <input type="radio" id="inlineRadio1" value="1" name="status" checked="">
                                            <label for="inlineRadio1">启用</label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="inlineRadio2" value="0" name="status">
                                            <label for="inlineRadio2">禁用</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
	                              		 @if ($errors->has('status'))
	                              		 	<span class="label label-danger">{{ $errors->first('status') }}</span>
								         @endif
	                              	</div>
                                </div>
                                
                               <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-2 col-sm-offset-7">
                                        <button class="btn btn-primary" type="submit">提交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
@section('js')
@parent
<!-- Chosen -->
<script src="{{ asset('back/admin/js/plugins/chosen/chosen.jquery.js') }}"></script>
<!-- the main fileinput plugin file -->
<script src="{{ asset('back/admin/js/fileinput.min.js') }}"></script>
    <script>
        $(document).ready(function(){
// 			头像上传初始化
			$("#input-id").fileinput();
        });
        var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
    </script>
@stop
@endsection
