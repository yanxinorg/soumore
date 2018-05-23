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
                            	<input type="text" placeholder="文章标题，作者，状态：已发布，未发布" class="input-md form-control">
                            	<span class="input-group-btn">
                                	<button type="button" class="btn btn-md btn-primary">Search</button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-md">
                            <div class="pull-right">
                                <a type="button" class="btn btn-md btn-white" href="{{ url('/post/create') }}"><i class="fa fa-plus">新增</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-stripped">
                            <thead>
                            <tr>
                                <th>文章名称</th>
                                <th>文章作者</th>
                                <th>状态</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>
                                        <a href="{{ URL::action('Front\PostController@detail', ['id'=>$post->post_id]) }}"><span> {{ str_limit($post->title,316) }}</span></a>
                                    </td>
                                    <td>
                                       <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$post->user_id]) }}">{{ $post->author }}</a>
                                    </td>
                                    <td>
                                        <select class="form-control" id="post_status">
                                            @if($post->status == 1)
                                              <option selected value="{{ $post->post_id }}"><span class="label label-primary">已发布</span></option>
                                              <option value="{{ $post->post_id }}"><span class="label label-danger">未发布</span></option>
                                            @else
                                              <option value="{{ $post->post_id }}"><span class="label label-primary">已发布</span></option>
                                              <option selected value="{{ $post->post_id }}"><span class="label label-danger">未发布</span></option>
                                            @endif
                                        </select>
                                    </td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-white" href="{{ URL::action('Front\PostController@edit', ['id'=>$post->post_id]) }}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-white " href="javascript:void(0);" onclick="del({{ $post->post_id }});"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                              @endforeach()
                            </tbody>
                        </table>
                        <div class="pull-right" >{{ $posts->links() }}</div>
                    </div>
            </div>
        </div>
    </div>
</div>
@section('js')
@parent
<script>

//改变分类状态
$("select#post_status").change(function(){
	 $.post("{{ url('/back/post/status') }}",
       {
         "_token":'{{ csrf_token() }}',
         "id": $(this).val(),
        },function(data){
//        	$.pjax.reload({container:"#post_status", async:true});
            toastr.success(data.msg, '状态');
        });
});

    //删除话题
    function del(id){
    	 swal({
             title: "确认删除该文章?",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "Yes, delete it!",
             closeOnConfirm: false
         }, function () {
         	 $.post("{{ url('/back/post/delete') }}",
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