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
.container-fluid .row-fluid .media{
	margin-bottom: 12px;
}
.container-fluid .row-fluid .media img{
	width:96px;
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
	                        	<a href="{{ URL::action('Front\PersonController@answer', ['cid'=>$cate->id]) }}"><button class="btn btn-danger btn-sm">{{ $cate->name }}</button></a>
								@else
								<a href="{{ URL::action('Front\PersonController@answer', ['cid'=>$cate->id]) }}"><button class="btn btn-default btn-sm">{{ $cate->name }}</button></a>
								@endif
							@endforeach()
                        </div>
                        <div class="btn-toolbar">
                            <h4 class="pull-right"></h4>
                        </div>
                    </header>
	                <section class="mail-list">
	                 @foreach($questions as $question)
	                	<div class="container-fluid" style="border-bottom:1px solid #D1D5E1;margin:12px 0px;">
							<div class="row-fluid" >
								<div class="span12" >
									<div class="media" style="margin-bottom: 12px;">
										<a href="#" class="pull-left"><img style="width:48px;" src="{{ route('getThumbImg', $question->user_id) }}" class="media-object" alt='' /></a>
										<div class="media-body">
											<div style="line-height:10px;margin-bottom:8px;"><span style="font-size: 14px;"><a target="_blank;" href="{{ URL::action('Front\HomeController@index', ['uid'=>$question->user_id]) }}">{{ $question->user_name }}</a></span><span style="margin-left:24px;font-size:12px;">{{\Carbon\Carbon::parse($question->created_at)->diffForHumans()}}</span></div>
											<h6 class="media-heading" style="font-size:10px;"><a target="_blank" href="{{ URL::action('Front\QuestionController@detail', ['id'=>$question->question_id]) }}">{{ $question->title }}</a></h6>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach() 
	                 </section>
	                    <div class="paginate" style="text-align:center;">{!! $questions->appends(array('cid'=>$cid))->render() !!}</div>
                </section>
          	<div class="paginate" style="text-align:center;"></div>
          </div>
          <div class="col-md-2 col-sm-3" >
             @component('wenda.slot.myquestionslot')
             @endcomponent
             @component('wenda.slot.noticeslot')
             @endcomponent
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