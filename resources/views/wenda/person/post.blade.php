@extends('layouts.wenda')
@section('content')
<style>
.mail-list{
	height:auto;
}
.panel .panel-body .auth-row{
	font-size: 12px;
	margin-bottom:4px;
}
.panel .panel-body .auth-row span{
	display:inline-block;
	margin:0px 8px;
}
.panel .panel-body .detail{
	font-size: 16px;
	color:#1ABC9C;
	float:right;
}
.nav_tabs{
	background-color:white;
	font-size: 16px;
	text-align:center;
	padding:4px 0px;
}
.mail-box-info .compose-btn a{
	margin-bottom:4px;
	display:inline-block;
}
.container-fluid{
	border-bottom:1px solid #D1D5E1;
	margin:12px 0px;
}

.container-fluid .row-fluid .media img{
	width:48px;
	height:48px;
}
.container-fluid .row-fluid .media-body .content{
	display:block;
	font-size: 14px;
}
.container-fluid .row-fluid .media-body .content h6{
	font-size:14px;
	display:inline-block;
	margin-left:80px;
}
.container-fluid .row-fluid .media-body .content span{
	 margin-left:24px;
}
.container-fluid .row-fluid .media-body .excerpt{
	font-size:12px;
	margin-left:24px;
	margin-top:6px;
}
.container-fluid .row-fluid .media-body .detail{
	font-size: 12px;
	color:#1ABC9C;
	float:right;
	margin-right:12px;
}
</style>
<div class="main-content">
  <div class="wrapper">
      <div class="directory-info-row">
          <div class="col-md-10 col-sm-9">
                <section class="mail-box-info">
                    <header class="header">
                        <div class="compose-btn pull-left">
	                        @foreach($cates as $cate)
	                        	@if($cate->id == $cid)
	                        	<a href="{{ URL::action('Front\PersonController@post', ['cid'=>$cate->id]) }}"><button class="btn btn-danger btn-sm">{{ $cate->name }}</button></a>
								@else
								<a href="{{ URL::action('Front\PersonController@post', ['cid'=>$cate->id]) }}"><button class="btn btn-default btn-sm">{{ $cate->name }}</button></a>
								@endif
							@endforeach()
                        </div>
                        <div class="btn-toolbar">
                            <h4 class="pull-right"></h4>
                        </div>
                    </header>
	                <section class="mail-list">
	                @foreach($datas as $data)
	                	@if($data->thumb)
		                	<div class="container-fluid" >
								<div class="row-fluid" >
									<div class="span12" >
										<div class="media" >
											<img class="pull-left" src="{{ route('getPostImg', $data->post_id) }}" class="media-object" />
											<div class="media-body">
												<div class="content" >
													<span><a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}">{{ $data->author }}</a></span>
													<span>{{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
													<span>{{ $data->countcomment }} 评论</span>
			                                        @if($data->status == 1)
			                                        <span class="label label-success">已发布</span>
			                                        @else
			                                        <span class="label label-danger">未发布</span>
			                                        @endif
												</div>
												<div class="excerpt">
													<a target="_blank" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ str_limit($data->title,316) }}</a>
												</div>
												<div class="pull-right">
													<a class="detail"  href="javascript:void(0);" onClick="del({{ $data->post_id }});">删除</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						@else
							<div class="container-fluid">
								<div class="row-fluid" >
									<div class="span12" >
										<div class="media">
										<img class="pull-left" src="{{ route('getThumbImg', $data->user_id) }}" class="media-object" />
											<div class="media-body">
												<div class="content" >
													<span><a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}">{{ $data->author }}</a></span>
													<span>{{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
													<span>{{ $data->countcomment }} 评论</span>
			                                        @if($data->status == 1)
			                                        <span class="label label-success">已发布</span>
			                                        @else
			                                        <span class="label label-danger">未发布</span>
			                                        @endif
												</div>
												<div class="excerpt">
													<a target="_blank" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ str_limit($data->title,316) }}</a>
												</div>
												<div class="pull-right">
													<a class="detail"  href="javascript:void(0);" onClick="del({{ $data->post_id }});">删除</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endif
					@endforeach() 
			         <div class="paginate" style="text-align:center;">{!! $datas->appends(array('cid'=>$cid))->render() !!}</div>
                    </section>
                </section>
          	<div class="paginate" style="text-align:center;"></div>
          </div>
          <div class="col-md-2 col-sm-3" >
             @component('wenda.slot.mycenterslot')
             @endcomponent
             <div class="category">
				<div class="col-md-12 col-sm-12" >
					<ul class="nav nav_tabs " >
						<li><a href="{{ URL::action('Front\PersonController@post', ['status'=>'1','cid'=>$cid]) }}">已发布</a></li>
						<li><a href="{{ URL::action('Front\PersonController@post', ['status'=>'0','cid'=>$cid]) }}">未发布</a></li>
					</ul>
				</div>
			</div>
			
          </div>
      </div>
  </div>
  <!--body wrapper end-->
</div>
@section('js')
@parent
<script type="text/javascript" src="{{ asset('wenda/layer/layer.js') }}" ></script>
<script type="text/javascript">
function del(id){
	layer.confirm('确认删除该文章？', {
        btn: ['确认','取消'] //按钮
    },function(){
    	$.post("{{ url('/post/del') }}",
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