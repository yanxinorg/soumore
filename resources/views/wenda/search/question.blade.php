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
							<a href="{{ URL::action('Front\SearchController@post', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">文章</button></a>
							<a href="{{ URL::action('Front\SearchController@wenda', ['wd'=>$wd]) }}"><button class="btn btn-success btn-sm">问答</button></a>
							<a href="{{ URL::action('Front\SearchController@topic', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">话题</button></a>
							<a href="{{ URL::action('Front\SearchController@user', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">用户</button></a>
                        </div>
                        <div class="btn-toolbar">
                            <h4 class="pull-right"></h4>
                        </div>
                    </header>
	                <section class="mail-list">
                         @foreach($datas as $question)
	                	<div class="container-fluid" style="border-bottom:1px solid #D1D5E1;margin:12px 0px;">
							<div class="row-fluid" >
								<div class="span12" >
									<div class="media" style="margin-bottom: 12px;">
										<a href="#" class="pull-left"><img style="width:48px;" src="{{ route('getThumbImg', $question->user_id) }}" class="media-object" /></a>
										<div class="media-body">
											<div style="line-height:10px;margin-bottom:8px;"><span style="font-size: 14px;"><a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$question->user_id]) }}">
												@php
												  $name = DB::table('users')->where('id',$question->user_id)->pluck('name');
												  echo $name[0];
												@endphp
											</a></span><span style="margin-left:24px;font-size:12px;">{{ $question->created_at }}</span></div>
											<h6 class="media-heading" style="font-size:10px;"><a target="_blank" href="{{ URL::action('Front\QuestionController@detail', ['id'=>$question->id]) }}">{{ $question->title }}</a></h6>
										</div>
									</div>
								</div>
							</div>
						</div>
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
<!-- main content end-->

@endsection
