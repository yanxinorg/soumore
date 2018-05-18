@extends('layouts.admin')
@section('content')
<style>
    select[multiple], select[size] {
        min-height: 300px;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
 <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="ibox-tools">
                               <div class="pull-right">
                               		<a type="button" class="btn btn-sm btn-white" href="{{ url('/back/role/list') }}"> <i class="fa fa-arrow-left">后退</i></a>
                                    <a type="button" class="btn btn-sm btn-white" href="{{ url('/back/role/list') }}"> <i class="fa fa-list">列表</i></a>
                               </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="{{ url('/back/role/update') }}" class="form-horizontal">
                            {{ csrf_field() }}
                            	<div class="form-group">
                                    <input type="text" class="form-control hidden" name="id" value="{{ $data->id }}">
                                </div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">角色名称</label>
                                    <div class="col-sm-6">
                                    	<input type="text" class="form-control" name="rolename" value="{{ $data->name }}"  placeholder="eg：administrator">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">角色别名</label>
                                    <div class="col-sm-6">
                                    	<input type="text" class="form-control" name="rolealias" value="{{ $data->display_name }}" placeholder="eg：管理员">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">角色备注</label>
                                    <div class="col-sm-6">
                                    	<textarea class="form-control" name="roleremark" rows="3">{{ $data->description }}</textarea>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">角色权限</label>
                                    <div class="col-sm-6">
                                    		<div class="row">
	                                    		 <div class="col-xs-5">
											        <select name="from[]" id="search" class="form-control" size="8" multiple="multiple">
											        	@foreach($froms as $from)
											            <option value="{{ $from->id }}">{{ $from->name }}</option>
											            @endforeach()
											        </select>
											    </div>
											    <div class="col-xs-2">
											        <button type="button" id="search_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
											        <button type="button" id="search_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
											        <button type="button" id="search_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
											        <button type="button" id="search_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
											    </div>
											    <div class="col-xs-5">
											        <select name="permits[]" id="search_to" class="form-control" size="8" multiple="multiple">
											        @foreach($tos as $to)
											            <option value="{{ $to->id }}">{{ $to->name }}</option>
											        @endforeach()
											        </select>
											    </div>
                                    		</div>
                                    </div>
                                </div>
                                
                               <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-2 col-sm-offset-7">
                                        <button class="btn btn-md btn-primary" type="submit">提交</button>
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
<script src="{{ asset('back/admin/js/multiselect.js') }}"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#search').multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
        },
        fireSearch: function(value) {
            return value.length > 3;
        }
    });
});
</script>
@stop
@endsection
