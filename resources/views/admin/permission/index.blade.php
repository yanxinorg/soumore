@extends('layouts.admin')
@section('content')
<!-- Sweet Alert -->
<link href="{{ asset('back/admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                             <h5>权限列表</h5>
                        </div>
                        <div class="ibox-content">
                        	<div class="m-b-lg">
                                <div class="m-t-md">
                                    <div class="pull-right">
		                                 <a type="button" class="btn btn-md btn-white" href="{{ url('/permit/add') }}"><i class="fa fa-plus">新增</i></a>
		                             </div>
                                    <strong>Found 61 issues.</strong>
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                            <table class="table table-hover issue-tracker">
                             	<thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>中文名</th>
                                        <th>Url</th>
                                        <th>备注</th>
                                        <th>创建时间</th>
                                        <th class="text-right" >操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($permits as $permit)
                                <tr>
                                    <td>{{ $permit->id }}</td>
                                    <td><span class="label label-primary">{{ $permit->display_name }}</span></td>
                                    <td>{{ $permit->name }}</td>
                                    <td>{{ $permit->description }}</td>
                                    <td>{{ $permit->created_at }}</td>
                                    <td class="text-right footable-visible footable-last-column">
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
<!-- Sweet alert -->
<script src="{{ asset('back/admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
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

