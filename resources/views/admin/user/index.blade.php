@extends('layouts.admin')
@section('content')
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>用户列表</h5>
                        </div>
                        <div class="ibox-content">
                        	<div class="row">
                                <div class="col-md-2 m-b-md"><select class="input-md form-control input-s-md inline">
                                    <option value="0">正常</option>
                                    <option value="1">禁用</option>
                                </select>
                                </div>
                                <div class="col-md-4 m-b-md">
                                    <div data-toggle="buttons" class="btn-group">
                                        <label class="btn btn-md btn-white"> <input type="radio" id="option1" name="options">all</label>
                                        <label class="btn btn-md btn-white"> <input type="radio" id="option2" name="options">male</label>
                                        <label class="btn btn-md btn-white active"> <input type="radio" id="option3" name="options">female</label>
                                    </div>
                                </div>
                                <div class="col-md-3 m-b-md">
                                    <div class="input-group">
                                    	<input type="text" placeholder="用户名称，邮箱，角色" class="input-md form-control"> 
                                    	<span class="input-group-btn">
                                        	<button type="button" class="btn btn-md btn-primary">Go!</button> 
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 m-b-md">
                                    <div class="pull-right">
                                        <a type="button" class="btn btn-md btn-white" href="{{ url('/user/add') }}"><i class="fa fa-plus">新增</i></a>
                                        <div class="dt-buttons btn-group">
	                                        <a class="btn btn-default buttons-csv buttons-html5" tabindex="0" aria-controls="DataTables_Table_0">
	                                        	<span>CSV</span>
	                                        </a>
	                                        <a class="btn btn-default buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_0">
	                                        	<span>Excel</span>
	                                        </a>
	                                        <a class="btn btn-default buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_0">
	                                        	<span>PDF</span>
	                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="table-responsive">
                            <table class="table table-hover issue-tracker">
                             	<thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>头像</th>
                                        <th>用户</th>
                                        <th>邮箱</th>
                                        <th>角色</th>
                                        <th><a href="">注册时间<span class="fa fa-fw fa-sort"></span></a></th>
                                        <th>状态</th>
                                        <th class="text-right" >操作</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td class="client-avatar"><img alt="image" src="{{ asset('back/admin/img/a2.jpg') }}"> </td>
                                    <td>{{ $user->name }}</td>
                                    <td ><i class="fa fa-envelope">  {{ $user->email }}</i></td>
                                    <td><span class="label label-primary">administrator</span></td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
	                                    <select class="form-control">
	                                       <option selected=""><span class="label label-primary">正常</span></option>
	                                       <option><span class="label label-danger">禁用</span></option>
	                                    </select>
                                    </td>
                                    <td class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <button class="btn btn-white"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-white"><i class="fa fa-eye"></i></button>
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
