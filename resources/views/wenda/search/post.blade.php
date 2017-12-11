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
</style>
<?php 
use Illuminate\Support\Facades\DB;
?>
<div class="main-content">
  <div class="wrapper">
      <div class="directory-info-row">
	      <div class="col-md-2 col-sm-2" >
			
	      </div>
          <div class="col-md-8 col-sm-8">
                <section class="mail-box-info">
                    <header class="header">
                        <div class="compose-btn pull-left">
							<a href="{{ URL::action('Front\SearchController@post', ['wd'=>$wd]) }}"><button class="btn btn-success btn-sm">文章</button></a>
							<a href="{{ URL::action('Front\SearchController@wenda', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">问答</button></a>
							<a href="{{ URL::action('Front\SearchController@topic', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">话题</button></a>
							<a href="{{ URL::action('Front\SearchController@user', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">用户</button></a>
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
											<img class="pull-left" src="{{ route('getPostImg', $data->id) }}" class="media-object" alt='没图没真相' />
											<div class="media-body">
												<div class="content" >
													<span>
														<a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}">
														@php
														  $name = DB::table('users')->where('id',$data->user_id)->pluck('name');
														  echo $name[0];
														@endphp
														</a>
													</span>
													<span>{{ $data->created_at }}</span>
													<h6 class="media-heading" ><a target="_blank" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->id]) }}">{{ str_limit($data->title,170) }}</a></h6>
												</div>
												<div class="excerpt">{{ str_limit($data->excerpt,316) }}</div>
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
											<div class="media-body">
												<div class="content" >
													<span><a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}">
														@php
														  $name = DB::table('users')->where('id',$data->user_id)->pluck('name');
														  echo $name[0];
														@endphp
													</a></span>
													<span>{{ $data->created_at }}</span>
													<h6 class="media-heading"><a target="_blank" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->id]) }}">{{ str_limit($data->title,170) }}</a></h6>
												</div>
												<div class="excerpt">{{ str_limit($data->excerpt,316) }}</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endif
					@endforeach() 
			         <div class="paginate" style="text-align:center;">{!! $datas->appends(array('wd'=>$wd))->render() !!}</div>
                    </section>
                </section>
          	<div class="paginate" style="text-align:center;"></div>
          </div>
          <div class="col-md-2 col-sm-2" >
            
          </div>
      </div>
  </div>
  <!--body wrapper end-->
</div>
@endsection
