@extends('layouts.wenda')
@section('content')
<style>
.mail-list{
	height:auto;
}
.nav_tabs{
	background-color:white;
	font-size: 16px;
	text-align:center;
	padding:4px 0px;
}
.tag .col-md-12{
	background-color:white;
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
}

.mail-box-info .compose-btn a{
	margin-bottom:4px;
	display:inline-block;
}
.main-content .wrapper .tag .revenue-nav li > a{
	text-transform:none;
}
</style>
<div class="main-content">
  <div class="wrapper">
      <div class="directory-info-row">
      <div class="col-md-2 col-sm-2" >
<!--       分类 -->
	      	<div class="category">
				<div class="col-md-12 col-sm-12" >
					<ul class="nav nav_tabs " >
						<li style="font-size: 16px; text-align:center;">
						 	<a href="{{ URL::action('Front\QuestionController@latest', ['tid'=>$tid,'cid'=>$cid]) }}">最新问答</a>
						</li>
						<li style="font-size: 16px; text-align:center;">
						 	<a href="{{ URL::action('Front\QuestionController@hottest', ['tid'=>$tid,'cid'=>$cid]) }}">热门问答</a>
						</li>
						<li style="font-size: 16px; text-align:center;">
						 	<a href="{{ URL::action('Front\QuestionController@unanswered', ['tid'=>$tid,'cid'=>$cid]) }}">待回答的</a>
						</li>
					</ul>
				</div>
			</div>
<!-- 		热门标签	 -->
			@if(!empty($tags[0]))
				<div class="tag" >
			        <div class="col-md-12 col-sm-12" style="margin-top:12px;">
			               <ul class="revenue-nav pull-left" >
			                     @foreach($tags as $tag)
			                     	@if($tag->id == $tid)
			                     		<li style="margin:4px;"><a style="background-color:red;" href="{{ URL::action('Front\QuestionController@tag', ['tid'=>$tag->id,'cid'=>$cid]) }}">{{ $tag->name }}</a></li>
			                     	@else
			                     		<li style="margin:4px;"><a href="{{ URL::action('Front\QuestionController@tag', ['tid'=>$tag->id,'cid'=>$cid]) }}">{{ $tag->name }}</a></li>
			                     	@endif
			                     @endforeach()
			              </ul>
			        </div>
				</div>
			@endif()
      </div>
          <div class="col-md-8 col-sm-8">
                <section class="mail-box-info">
                    <header class="header">
                        <div class="compose-btn pull-left">
                         	@foreach($cates as $cate)
	                        	@if($cate->id == $cid)
	                        	<a href="{{ URL::action('Front\QuestionController@cate', ['cid'=>$cate->id]) }}"><button class="btn btn-danger btn-sm">{{ $cate->name }}</button></a>
								@else
								<a href="{{ URL::action('Front\QuestionController@cate', ['cid'=>$cate->id]) }}"><button class="btn btn-default btn-sm">{{ $cate->name }}</button></a>
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
										<a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$question->user_id]) }}" class="pull-left"><img style="width:48px;" src="{{ route('getThumbImg', $question->user_id) }}" class="media-object" /></a>
										<div class="media-body">
											<div style="line-height:10px;margin-bottom:8px;"><span style="font-size: 14px;"><a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$question->user_id]) }}">{{ $question->user_name }}</a></span><span style="margin-left:24px;font-size:12px;">{{\Carbon\Carbon::parse($question->created_at)->diffForHumans()}}</span></div>
											<h6 class="media-heading" style="font-size:10px;"><a target="_blank" href="{{ URL::action('Front\QuestionController@detail', ['id'=>$question->question_id]) }}">{{ $question->title }}</a></h6>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach() 
	                   </section>
	                    <div class="paginate" style="text-align:center;">{!! $questions->appends(array('cid'=>$cid,'tid'=>$tid))->render() !!}</div>
                </section>
          	<div class="paginate" style="text-align:center;"></div>
          </div>
          <div class="col-md-2 col-sm-2" >
             @component('wenda.slot.myquestionslot')
             @endcomponent
             @component('wenda.slot.noticeslot')
             @endcomponent
          </div>
      </div>
  </div>
  <!--body wrapper end-->
</div>
<!-- main content end-->

@endsection
