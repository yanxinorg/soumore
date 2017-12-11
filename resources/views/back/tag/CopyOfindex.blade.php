@extends('layouts.back')
@section('content')
<!--nestable css-->
<link href="{{ asset('back/js/nestable/jquery.nestable.css') }}" rel="stylesheet">
<link href="{{ asset('back/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('back/css/style-responsive.css') }}" rel="stylesheet">
<!--file upload-->
<link rel="stylesheet" type="text/css" href="{{ asset('back/css/bootstrap-fileupload.min.css') }}" />
<section class="wrapper ">
    <div class="row">
            <div class="col-lg-6 col-sm-6 ">
                <section class="panel">
    	            <header class="panel-heading">添加话题</header>
    	            <div class="panel-body">
    	                <form class="form-horizontal adminex-form" method="post" action="{{ url('/back/tag/update') }}" enctype="multipart/form-data">
    	                {{ csrf_field() }}
    	                	<div class="form-group" hidden>
    	                        <div class="col-sm-6 col-sm-6">
    	                            <input type="text" name="id" class="form-control" value="{{ $tag->id }}" >
    	                        </div>
    	                    </div>
    	                    <div class="form-group">
    	                        <label class="col-sm-2 col-sm-2 control-label"><span style="color: red;">*</span>话题名称</label>
    	                        <div class="col-sm-6 col-sm-6">
    	                            <input type="text" class="form-control" value="{{ $tag->name }}" disabled>
    	                        </div>
    	                          @if ($errors->has('name'))
    	                          <div class="col-sm-4 col-sm-4">
                                     <span style="color:red;">{{ $errors->first('name') }}</span>
    	                          </div>
                             	  @endif
    	                    </div>
    	                   
    						<div class="form-group last">
                                    <label class="control-label col-md-2"><span style="color: red;">*</span>缩略图</label>
                                    <div class="col-md-6">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">
                                            </div>
                                            <div>
                                               <span class="btn btn-default btn-file" style="margin-left:0.5px;">
    	                                           <span class="fileupload-new">Select</span>
    	                                           <span class="fileupload-exists"><i class="fa fa-undo"></i>重置</span>
    	                                           <input type="file" name="thumb" class="default"/>
                                               </span>
                                               <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i>移除</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                          @if ($errors->has('thumb'))
                                             <span style="color:red;">{{ $errors->first('thumb') }}</span>
                                     	  @endif
                                    </div>
                            </div>
    	                    <div class="form-group">
    	                        <label class="col-sm-2 col-md-2 control-label">话题描述</label>
    	                        <div class="col-md-10 col-sm-10">
    	                            <textarea rows="6" class="form-control" name="desc">{{ $tag->desc }}</textarea>
    	                        </div>
    	                    </div>
    	                    <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                            </div>
    	                </form>
    	            </div>
            	</section>
            </div>
            <div class="col-lg-6 col-sm-6 ">
                <section class="panel">
                    <header class="panel-heading">话题列表</header>
                    <div class="panel-body">
                     @foreach($datas as $data)
                       <div class="media blog-cmnt">
                       		<div class="pull-left">
                       			<img alt="" src="{{ route('getTagImg', $data->id) }}" class="media-object">
                       		</div>
		                    <div class="media-body">
		                        <h4 class="media-heading">
		                            <a href="#">{{ $data->name }}</a>
		                             <a href="{{ route('tag.edit',['id'=>$data->id]) }}" class="btn btn-sm pull-right">删除</a>
		                            <a href="{{ route('notice.edit',['id'=>$data->id]) }}" class="btn btn-sm pull-right">通过</a>
		                            <a href="{{ route('tag.edit',['id'=>$data->id]) }}" class="btn btn-sm pull-right">编辑</a>
		                        </h4>
		                        <p class="mp-less">{{ $data->desc }}</p>
		                    </div>
		                </div>
		             @endforeach()
		             {!! $datas->appends(array('tid'=>$tid))->render() !!}
                    </div>
                </section>
            </div>
    </div>
</section>
@section('js')
@parent
<!--common scripts for all pages-->
<script type="text/javascript" src="{{ URL::asset('back/js/fuelux/js/spinner.min.js') }}"></script>
<script src="{{ URL::asset('back/js/spinner-init.js') }}"></script>
<script src="{{ URL::asset('back/js/nestable/jquery.nestable.js') }}"></script>
<script src="{{ URL::asset('back/js/nestable-init.js') }}"></script>
<!--file upload-->
<script type="text/javascript" src="{{ URL::asset('back/js/bootstrap-fileupload.min.js') }}"></script>
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
