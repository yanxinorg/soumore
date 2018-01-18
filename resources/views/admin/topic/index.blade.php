@extends('layouts.admin')
@section('content')
 <div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                    <div class="ibox-content">
                	<div class="row">
                        <div class="col-md-3 m-b-md">
                            <select class="input-md form-control input-s-md inline">
                                <option value="0">启用</option>
                                <option value="1">禁用</option>
                            </select>
                        </div>
                        <div class="col-md-3 m-b-md">
                            <div class="input-group">
                            	<input type="text" placeholder="话题名称" class="input-md form-control"> 
                            	<span class="input-group-btn">
                                	<button type="button" class="btn btn-md btn-primary">Go!</button> 
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-md">
                            <div class="pull-right">
                                <a type="button" class="btn btn-md btn-white" href="{{ url('/topic/add') }}"><i class="fa fa-plus">新增</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="tab-4" class="tab-pane active">
                            <table class="table table-bordered table-stripped">
                                <thead>
                                <tr>
                                    <th>缩略图</th>
                                    <th>话题名称</th>
                                    <th>状态</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('back/admin/img/gallery/2s.jpg') }}">
                                        </td>
                                        <td>{{ $tag->name }}</td>
                                        <td>
                                        	<select class="form-control">
		                                       <option selected=""><span class="label label-primary">正常</span></option>
		                                       <option><span class="label label-danger">禁用</span></option>
	                                    	</select>
                                        </td>
                                        <td>{{ $tag->created_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-white"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-white demo3"><i class="fa fa-trash"></i></button>
                                        	</div>
                                        </td>
                                    </tr>
                                  @endforeach()
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@section('js')
@parent
<script>
    $(document).ready(function () {
        $('.demo3').click(function () {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
        });
    });
</script>
@stop
@endsection