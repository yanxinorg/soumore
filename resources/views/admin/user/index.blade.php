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
                                <div class="col-md-3 m-b-md">
                                    <select class="input-md form-control input-s-md inline" name="searchid">
                                        <option value="1">启用</option>
                                        <option value="0">禁用</option>
                                    </select>
                                </div>
                                <div class="col-md-6 m-b-md">
                                    <form action="{{ url('/back/search/user') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="input-group">
                                            <input type="text" placeholder="用户名，邮箱" name="wd" value="{{ $wd }}"  class="input-md form-control">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-md btn-primary">Search</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3 m-b-md">
                                    <div class="pull-right">
                                        <div class="dt-buttons btn-group">
	                                        <a href="{{ url('/back/user/add') }}" class="btn btn-default buttons-csv buttons-html5" tabindex="0" aria-controls="DataTables_Table_0">
	                                        	<span><i class="fa fa-plus">新增</i></span>
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
                                    <td class="client-avatar"><img alt="image" src="{{ $user->avator }}"> </td>
                                    <td><a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$user->id]) }}">{{ $user->name }}</a></td>
                                    <td ><i class="fa fa-envelope">  {{ $user->email }}</i></td>
                                    <td><span class="label label-primary">administrator</span></td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
	                                    <select class="form-control" id="user_status">
            					            @if($user->status == 1)
            		                            <option selected value="{{ $user->id }}"><span class="label label-primary">启用</span></option>
            		                            <option value="{{ $user->id }}"><span class="label label-danger">禁用</span></option>
            								@else
            									<option value="{{ $user->id }}"><span class="label label-primary">启用</span></option>
            									<option selected value="{{ $user->id }}"><span class="label label-danger">禁用</span></option>
            								@endif
	                                    </select>
                                    </td>
                                    <td class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <a class="btn btn-white" href="{{ URL::action('Admin\UserController@edit', ['id'=>$user->id]) }}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-white " href="javascript:void(0);" onclick="del({{ $user->id }});"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach()
                                </tbody>
                            </table>
                                <div class="pull-right">{!! $users->appends(array('wd'=>$wd))->render() !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@section('js')
@parent
<script>
//删除用户
function del(id){
	 swal({
         title: "确认删除该用户?",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#DD6B55",
         confirmButtonText: "Yes, delete it!",
         closeOnConfirm: false
     }, function () {
     	 $.post("{{ url('/back/user/delete') }}",
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
//改变用户状态
$("select#user_status").change(function(){
    $.post("{{ url('/back/user/status') }}",
            {
                "_token":'{{ csrf_token() }}',
                "id": $(this).val(),
            },function(data){
                $.pjax.reload({container:"#user_status", async:true});
                //通知
                setTimeout(function() {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                    toastr.success('更新成功', '状态');
                }, 300);

            });
});
</script>
@stop
@endsection
