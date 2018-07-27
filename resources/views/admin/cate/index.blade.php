@extends('layouts.admin')
@section('content')
 <div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                    <div class="ibox-content">
                        <div class="row">
                            <form action="{{ url('/back/search/cate') }}" method="post">
                                {{ csrf_field() }}
                                <div class="col-md-6 m-b-md">
                                    <div class="input-group">
                                        <input type="text" placeholder="分类名称" name="wd" value="{{ $wd }}"  class="input-md form-control">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-md btn-primary">Search</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-6 m-b-md">
                                <div class="pull-right">
                                    <a type="button" class="btn btn-md btn-white" href="{{ url('/back/cate/add') }}"><i class="fa fa-plus">新增</i></a>
                                </div>
                            </div>
                        </div>
                    <div class="tab-content">
                        <div id="tab-4" class="tab-pane active">
                            <table class="table table-bordered table-stripped">
                                <thead>
                                <tr>
                                    <th>分类ID</th>
                                    <th>缩略图</th>
    					            <th>分类名称</th>
    					            <th>分类状态</th>
    					            <th>创建时间</th>
    					            <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cates as $cate)
        					        <tr class="gradeX">
        					            <td>{{ $cate->id }}</td>
        					            <td>
                                            <img style="width:36px;" src="{{ $cate->thumb }}">
                                        </td>
        					            <td>
        					             @if( $cate->count != 0)
        	                                @for ($i=0;$i<$cate->count;$i++)
        	                                	@if( $i == 0)
        	    								<span></span>
        	    								@else
        	    								<span style="color:#1C84C6;">&nbsp;|&nbsp;---------</span>
        	    								@endif
        	                                @endfor
	        	                             @if( $cate->status == "1")
	        	                             	<span class="label label-success">{{ $cate->name }}</span>
	        	                             @else
	        	                             	<span class="label label-danger">{{ $cate->name }}</span>
	        	                             @endif
        	                             @endif
        					            </td>
        					            <td>
        					              	<select class="form-control" id="cate_status">
            					              	@if($cate->status == 1)
            		                              <option selected value="{{ $cate->id }}"><span class="label label-primary">启用</span></option>
            		                              <option value="{{ $cate->id }}"><span class="label label-danger">禁用</span></option>
            									@else
            									  <option value="{{ $cate->id }}"><span class="label label-primary">启用</span></option>
            									  <option selected value="{{ $cate->id }}"><span class="label label-danger">禁用</span></option>
            									@endif
	                                    	</select>
        					            </td>
        					            <td>{{ $cate->created_at }}</td>
        					            <td>
        					             	<div class="btn-group">
            					             	@if($cate->status == 1)
                					             <a class="btn btn-white" href="{{ URL::action('Admin\CateController@addChild',['id'=>$cate->id]) }}"><i class="fa fa-plus"></i></a>
            									@endif
                                                <a class="btn btn-white" href="{{ URL::action('Admin\CateController@edit', ['id'=>$cate->id])}}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-white " href="javascript:void(0);" onclick="del({{ $cate->id }});"><i class="fa fa-trash"></i></a>
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
//改变分类状态
$("select#cate_status").change(function(){
	 $.post("{{ url('/back/cate/status') }}",
       {
         "_token":'{{ csrf_token() }}',
         "id": $(this).val(),
        },function(data){
             toastr.success(data.msg, '状态');
             location.reload() ;
        });
});
	
//删除分类
function del(id){
	 swal({
         title: "确认删除该分类?",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#DD6B55",
         confirmButtonText: "Yes, delete it!",
         closeOnConfirm: false
     }, function () {
     	 $.post("{{ url('/back/cate/delete') }}",
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
                          location.reload() ;
                    	     });
                  });
     });
	
}
</script>
@stop
@endsection