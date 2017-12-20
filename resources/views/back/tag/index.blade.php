@extends('layouts.back')
@section('content')
<section class="wrapper ">
    <div class="row">
            <div class="col-md-12 col-sm-6 ">
                <section class="panel">
                        <header class="panel-heading">标签话题
                            <span class="tools pull-right">
                                 <a href="{{ url('/back/tag/create') }}" >新增话题</a>
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
						                        <th>话题名称</th>
						                        <th>话题描述</th>
						                        <th class="text-center">话题缩略图</th>
						                        <th class="text-center">话题状态</th>
						                        <th class="text-center">创建时间</th>
						                        <th class="text-center">操作</th>
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
						                            <p>{{ $data->desc }}</p>
						                        </td>
						                        <td class="text-center"><img alt="话题缩略图" style="width:128px;" src="{{ route('getTopicImg', $data->id) }}"></td>
						                        <td class="text-center">
						                        	@if( $data->status == 1)
						                        	<span class="label label-success label-mini">启用</span>
													@else
													<span class="label label-danger label-mini">禁用</span>
													@endif
						                        </td>
						                        <td class="text-center"><strong>{{ $data->created_at }}</strong></td>
						                        <td class="text-center">
						                        <a href="javascript:void(0);" class="btn btn-info btn-xs">编辑</a>
			                            		<a href="javascript:void(0);" onclick="del({{ $data->id }});" class="btn btn-danger btn-xs">删除</a>
						                        </td>
						                    </tr>
						                    @endforeach
						                    </tbody>
						                </table>
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
        layer.confirm('确认删除该话题？', {
            btn: ['确认','取消'] //按钮
        },function(){
            $.post("{{ url('/back/tag/delete') }}",
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
