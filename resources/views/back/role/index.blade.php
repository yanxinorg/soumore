@extends('layouts.back')
@section('content')
<section class="wrapper ">
    <div class="row">
            <div class="col-md-12 col-sm-6 ">
                <section class="panel">
                        <header class="panel-heading">用户列表
                            <span class="tools pull-right">
                                 <a href="{{ url('/back/role/create') }}" >新增角色</a>
                             </span>
                        </header>
                        <div class="panel-body">
                             <!--body wrapper start-->
						        <div class="wrapper">
						            <div class="panel">
						                <table class="table table-bordered table-invoice">
						                    <thead>
						                    <tr>
						                        <th>#</th>
						                        <th>标识</th>
						                        <th>角色名</th>
						                        <th>备注</th>
						                        <th>创建时间</th>
						                        <th>操作</th>
						                    </tr>
						                    </thead>
						                    <tbody>
						                    @foreach($datas as $data)
						                    <tr>
						                        <td>{{ $data->id }}</td>
						                        <td>
						                            <h4>{{ $data->name }}</h4>
						                        </td>
						                        <td>
						                            <p>{{ $data->display_name }}</p>
						                        </td>
						                        <td class="text-center">{{ $data->description }}</td>
						                        <td class="text-center">{{ $data->created_at }}</td>
						                        <td class="text-center">
						                        <a href="javascript:void(0);" class="btn btn-info btn-xs">编辑</a>
			                            		<a href="javascript:void(0);" onclick="del({{ $data->id }});" class="btn btn-danger btn-xs">删除</a>
						                        </td>
						                    </tr>
						                    @endforeach()
						                    </tbody>
						                </table>
						                <div class="paginate" style="text-align:right;">{{ $datas->links() }}</div>
						            </div>
						        </div>
						        <!--body wrapper end-->
                        </div>
                    </section>
            </div>
    </div>
</section>
@section('js')
@parent
<script type="text/javascript" src="{{ URL::asset('back/layer/layer.js') }}"></script>
<script type="text/javascript">
    function del(id){
        layer.confirm('确认删除该角色？', {
            btn: ['确认','取消'] //按钮
        },function(){
            $.post("{{ url('/back/role/delete') }}",
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
