@extends('layouts.back')
@section('content')
<!-- table -->
<link href="{{ asset('back/js/advanced-datatable/css/demo_table.css') }}" rel="stylesheet">
<link href="{{ asset('back/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('back/css/style-responsive.css') }}" rel="stylesheet">
<section class="wrapper ">
    <div class="row">
        <div class="col-sm-12">
         <section class="panel">
	        <header class="panel-heading">
	           	 分类列表
	            <span class="tools pull-right">
	                <a href="{{ url('/back/cate/create') }}" >新增分类</a>
	             </span>
	        </header>
	        <div class="panel-body">
		        <div class="adv-table">
			        <table  class="display table table-bordered table-striped" id="dynamic-table">
				        <thead>
					        <tr>
					            <th>分类ID</th>
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
					             @if( $cate->count != 0)
	                                @for ($i=0;$i<$cate->count;$i++)
	                                	@if( $i == 0)
	    								<span></span>
	    								@else
	    								<span>&nbsp;|&nbsp;---------</span>
	    								@endif
	                                @endfor
	                             {{ $cate->name }}
	                             @endif
					            </td>
					            <td>
					              	@if($cate->status == 1)
		                             <button type="button" class="btn btn-success btn-xs">启用</button>
									@else
									 <button type="button" class="btn btn-danger btn-xs">禁用</button>
									@endif
					            </td>
					            <td>{{ $cate->created_at }}</td>
					            <td>
					             	@if($cate->status == 1)
			                            <a href="{{ URL::action('Back\CategoryController@addChild',['id'=>$cate->id]) }}" class="btn btn-primary btn-xs">添加子分类</a>
			                            <a href="{{ URL::action('Back\CategoryController@edit', ['id'=>$cate->id])}}" class="btn btn-info btn-xs">编辑</a>
			                            <a href="javascript:void(0);" onclick="del({{ $cate->id }});" class="btn btn-danger btn-xs">删除</a>
									@else
										<a href="{{ URL::action('Back\CategoryController@edit', ['id'=>$cate->id])}}" class="btn btn-info btn-xs">编辑</a>
			                            <a href="javascript:void(0);" onclick="del({{ $cate->id }});" class="btn btn-danger btn-xs">删除</a>
									@endif
					            </td>
					        </tr>
					        @endforeach()
				        </tbody>
			        </table>
		        </div>
	        </div>
        </section>
      </div>
   </div>
</section>
@section('js')
@parent
<!-- layer -->
<script type="text/javascript" src="{{ URL::asset('back/layer/layer.js') }}"></script>
<script>
function del(id){
    layer.confirm('确认删除该分类？', {
        btn: ['确认','取消'] //按钮
    },function(){
        $.post("{{ url('/cate/delete') }}",
                {
                "_token":'{{ csrf_token() }}',
                "id": id,
                },function(data){
                    if(data.code)
                    {
                        layer.msg(data.msg);
                        location.reload();
                    }else{
                        layer.msg(data.msg);
                        }
                });
        },function(){
            
            });
    
}
</script>
@stop
@endsection
