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
                            	<input type="text" placeholder="话题名称，状态：启用，禁用" class="input-md form-control">
                            	<span class="input-group-btn">
                                	<button type="button" class="btn btn-md btn-primary">Go!</button> 
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-md">
                            <div class="pull-right">
                                <a type="button" class="btn btn-md btn-white" href="{{ url('/back/topic/add') }}"><i class="fa fa-plus">新增</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="tab-4" class="tab-pane active">
                            <table class="table table-bordered table-stripped">
                                <thead>
                                <tr>
                                    <th>ID</th>
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
                                        <td style="width: 50px;">{{ $tag->id }}</td>
                                        <td style="width: 50px;">
                                            <img style="width:48px;" src="{{ $tag->thumb }}">
                                        </td>
                                        <td>
                                         	@if( $tag->status == "1")
	        	                             	<span class="label label-success"> {{ $tag->name }}</span>
	        	                             @else
	        	                             	<span class="label label-danger"> {{ $tag->name }}</span>
	        	                             @endif
                                        </td>
                                        <td>
                                        	<select class="form-control" id="topic_status">
		                                        @if($tag->status == 1)
            		                              <option selected value="{{ $tag->id }}"><span class="label label-primary">启用</span></option>
            		                              <option value="{{ $tag->id }}"><span class="label label-danger">禁用</span></option>
            									@else
            									  <option value="{{ $tag->id }}"><span class="label label-primary">启用</span></option>
            									  <option selected value="{{ $tag->id }}"><span class="label label-danger">禁用</span></option>
            									@endif
	                                    	</select>
                                        </td>
                                        <td>{{ $tag->created_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-white" href="{{ URL::action('Admin\TopicController@edit', ['id'=>$tag->id])}}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-white " href="javascript:void(0);" onclick="del({{ $tag->id }});"><i class="fa fa-trash"></i></a>
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
    $("select#topic_status").change(function(){
    	 $.post("{{ url('/back/topic/status') }}",
           {
             "_token":'{{ csrf_token() }}',
             "id": $(this).val(),
            },function(data){
                toastr.success('更新成功', '状态');
            	$.pjax.reload({container:"#topic_status", async:true});
            });
    });

    //删除话题
    function del(id){
    	 swal({
             title: "确认删除该话题?",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "Yes, delete it!",
             closeOnConfirm: false
         }, function () {
         	 $.post("{{ url('/back/topic/delete') }}",
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