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
                                    <strong>共 61 条路由.</strong>
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                            <table class="table table-hover issue-tracker">
                             	<thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>中文</th>
                                        <th>英文</th>
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
                                    <td>{{ $permit->created_at }}</td>
                                    <td class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <a class="btn btn-white" href="{{ URL::action('Admin\PermissionController@edit', ['id'=>$permit->id])}}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-white " href="javascript:void(0);" onclick="del({{ $permit->id }});"><i class="fa fa-trash"></i></a>
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
//删除话题
function del(id){
	 swal({
         title: "确认删除该路由?",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#DD6B55",
         confirmButtonText: "Yes, delete it!",
         closeOnConfirm: false
     }, function () {
     	 $.post("{{ url('/permit/delete') }}",
                  {
                  "_token":'{{ csrf_token() }}',
                  "id": id,
                  },function(data){
                	  swal({
                	         title: data.msg,
                	         confirmButtonColor: "#DD6B55",
                	         animation: false,
                	         showConfirmButton: true
                	     }, function () {
                	    	 $.pjax.reload('table');
                    	     });
                  });
     });
	
}
</script>
@stop
@endsection

