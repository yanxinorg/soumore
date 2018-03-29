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
                            	<input type="text" placeholder="链接名称" class="input-md form-control"> 
                            	<span class="input-group-btn">
                                	<button type="button" class="btn btn-md btn-primary">Go!</button> 
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-md">
                            <div class="pull-right">
                                <a type="button" class="btn btn-md btn-white" href="{{ url('/back/link/add') }}"><i class="fa fa-plus">新增</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="tab-4" class="tab-pane active">
                            <table class="table table-bordered table-stripped">
                                <thead>
                                <tr>
                                    <th>链接ID</th>
                                    <th>缩略图</th>
    					            <th>链接名称</th>
    					            <th>链接Url</th>
    					            <th>链接状态</th>
    					            <th>创建时间</th>
    					            <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($links as $link)
        					        <tr class="gradeX">
        					            <td>{{ $link->id }}</td>
        					            <td>
                                            <img style="width:36px;" src="{{ $link->thumb }}">
                                        </td>
        					            <td>{{ $link->name }}</td>
        					            <td>{{ $link->url }}</td>
        					            <td>
        					              	<select class="form-control" id="link_status">
            					              	@if($link->status == 1)
            		                              <option selected value="{{ $link->id }}">启用</option>
            		                              <option value="{{ $link->id }}">禁用</option>
            									@else
            									  <option value="{{ $link->id }}">启用</option>
            									  <option selected value="{{ $link->id }}">禁用</option>
            									@endif
	                                    	</select>
        					            </td>
        					            <td>{{ $link->created_at }}</td>
        					            <td>
        					             <div class="btn-group">
                							<a class="btn btn-white" href="{{ URL::action('Admin\LinkController@edit', ['id'=>$link->id])}}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-white " href="javascript:void(0);" onclick="del({{ $link->id }});"><i class="fa fa-trash"></i></a>
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
//改变分类状态
$("select#link_status").change(function(){
	 $.post("{{ url('/back/link/status') }}",
       {
         "_token":'{{ csrf_token() }}',
         "id": $(this).val(),
        },function(data){
        	$.pjax.reload({container:"#link_status", async:true});
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
	
//删除分类
function del(id){
	 swal({
         title: "确认删除该链接?",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#DD6B55",
         confirmButtonText: "Yes, delete it!",
         closeOnConfirm: false
     }, function () {
     	 $.post("{{ url('/back/link/delete') }}",
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