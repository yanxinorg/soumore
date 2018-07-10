@extends('layouts.admin')
@section('content')
 <div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                    <div class="ibox-content">
                	<div class="row">
                        <div class="col-md-6 m-b-md">
                            <div class="input-group">
                            	<input type="text" placeholder="公告名称" class="input-md form-control">
                            	<span class="input-group-btn">
                                	<button type="button" class="btn btn-md btn-primary">Go!</button> 
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-md">
                            <div class="pull-right">
                                <a type="button" class="btn btn-md btn-white" href="{{ url('/back/notice/add') }}"><i class="fa fa-plus">新增</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="tab-4" class="tab-pane active">
                            <table class="table table-bordered table-stripped">
                                <thead>
                                <tr>
                                    <th>链接ID</th>
                                    <th>公告标题</th>
                                    <th>内容</th>
    					            <th>创建时间</th>
    					            <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
        					        <tr class="gradeX">
        					            <td>{{ $data->id }}</td>
        					            <td>{{ $data->title }}</td>
                                        <td>{!! $data->content !!}</td>
        					            <td>{{ $data->created_at }}</td>
        					            <td>
        					             <div class="btn-group">
                							<a class="btn btn-white" href="{{ URL::action('Admin\NoticeController@edit', ['id'=>$data->id])}}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-white " href="javascript:void(0);" onclick="del({{ $data->id }});"><i class="fa fa-trash"></i></a>
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
 </div>
@section('js')
@parent
<script>
//删除公告
function del(id){
	 swal({
         title: "确认删除该公告?",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#DD6B55",
         confirmButtonText: "Yes, delete it!",
         closeOnConfirm: false
     }, function () {
     	 $.post("{{ url('/back/notice/delete') }}",
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