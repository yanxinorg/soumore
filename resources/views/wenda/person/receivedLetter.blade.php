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

<div class="main-content">
  <div class="wrapper">
      <div class="directory-info-row">
          <div class="col-md-10 col-sm-9">
                <section class="mail-box-info">
                    <header class="header">
                        <div class="compose-btn pull-left">
                            <a href="{{ url('/person/letter') }}"><button class="btn btn-success btn-sm">我的私信</button></a>
                            <a href="{{ url('/person/sendLetter') }}"><button class="btn btn-default btn-sm ">写私信</button></a>
                        </div>
                        <div class="btn-toolbar">
                            <h4 class="pull-right"></h4>
                        </div>
                    </header>
	                <section class="mail-list">
	                @foreach($datas as $data)
	                	<div class="container-fluid" style="border-bottom:1px solid #D1D5E1;margin:12px 0px;">
							<div class="row-fluid" >
								<div class="span12" >
									<div class="media" style="margin-bottom: 12px;">
										<a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->id]) }}" class="pull-left"><img style="width:48px;" src="{{ route('getThumbImg', $data->id) }}" class="media-object" /></a>
										<div class="media-body">
											<div style="line-height:10px;margin-bottom:8px;"><span style="font-size: 14px;"><a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->id]) }}">{{ $data->username }}</a></span><span style="margin-left:24px;font-size:12px;">{{ $data->created_at }}</span></div>
											<h6 class="media-heading" style="font-size:10px;">{{ $data->content }}</h6>
											<a style="font-size:10px;" target="_blank" href="{{ URL::action('Front\PersonController@letterDetail', ['from_user_id'=>$data->from_user_id,'to_user_id'=>$data->to_user_id]) }}" class="pull-right">展开</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach()
					<div class="paginate" style="text-align:center;">{!! $datas->links() !!}</div>
	                </section>
                </section>
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
