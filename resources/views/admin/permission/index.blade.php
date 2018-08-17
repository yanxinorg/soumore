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
                            <div class="row">
                                <div class="col-md-6 m-b-md">
                                    <div class="input-group">
                                        <input type="text" placeholder="权限名称" class="input-md form-control">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-md btn-primary">Search</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 m-b-md">
                                    <div class="pull-right">
                                        <a type="button" class="btn btn-md btn-white" href="{{ url('/back/permit/add') }}"><i class="fa fa-plus">新增</i></a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-stripped">
                             	<thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>中文</th>
                                        <th>英文</th>
                                        <th>创建时间</th>
                                        <th >操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($permits as $permit)
                                <tr>
                                    <td>{{ $permit->id }}</td>
                                    <td><span class="label label-primary">{{ $permit->display_name }}</span></td>
                                    <td>{{ $permit->name }}</td>
                                    <td>{{ $permit->created_at }}</td>
                                    <td class="footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <a class="btn btn-white" href="{{ URL::action('Admin\PermissionController@edit', ['id'=>$permit->id])}}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-white " href="javascript:void(0);" onclick="del({{ $permit->id }});"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach()
                                </tbody>
                            </table>
                            <div class="paginate" >{{ $permits->links() }}</div>
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
     	 $.post("{{ url('/back/permit/delete') }}",
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

