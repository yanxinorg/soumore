@extends('layouts.wenda')
@section('content')
<style>
.mail-list{
	height:auto;
}
.blog-img-sm{
	text-align: center;
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
.container-fluid{
	border-bottom:1px solid #D1D5E1;
	margin:12px 0px;
}
.container-fluid .row-fluid .media{
	margin-bottom: 12px;
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
</style>

<div class="main-content">
  <div class="wrapper">
      <div class="directory-info-row">
          <div class="col-md-10 col-sm-9">
                <section class="mail-box-info">
                    <header class="header">
                        <div class="compose-btn pull-left">
                            <a href="{{ url('/person/postCollect') }}"><button class="btn btn-success btn-sm">收藏的文章</button></a>
                            <a href="{{ url('/person/answerCollect') }}"><button class="btn btn-sm btn-default">收藏的问答</button></a>
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
											<img class="pull-left" src="{{ route('getPostImg', $data->post_id) }}" class="media-object" alt='没图没真相' />
											<div class="media-body">
												<div class="content" >
													<span><a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}">{{ $data->author }}</a></span>
													<span>{{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
												</div>
												<div class="excerpt">
													<a target="_blank" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ str_limit($data->title,316) }}</a>
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
										<img class="pull-left" src="{{ route('getThumbImg', $data->user_id) }}" class="media-object" alt='没图没真相'/>
											<div class="media-body">
												<div class="content" >
													<span><a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}">{{ $data->author }}</a></span>
													<span>{{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
												</div>
												<div class="excerpt">
													<a target="_blank" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ str_limit($data->title,316) }}</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endif
					@endforeach() 
			        <div class="paginate" style="text-align:center;">{{ $datas->links() }}</div>
                    </section>
                </section>
          	<div class="paginate" style="text-align:center;"></div>
          </div>
          <div class="col-md-2 col-sm-3" >
             @component('wenda.slot.mycenterslot')
             @endcomponent
          </div>
      </div>
  </div>
  <!--body wrapper end-->
</div>
<!-- main content end-->

@endsection
