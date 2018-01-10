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
                            <a href="{{ url('/person/topicAttention') }}"><button class="btn btn-sm btn-default">关注的话题</button></a>
                            <a href="{{ url('/person/userAttention') }}"><button class="btn btn-success btn-sm">关注的用户</button></a>
                        </div>
                        <div class="btn-toolbar">
                            <h4 class="pull-right"></h4>
                        </div>
                    </header>
	                <section class="mail-list">
                      <div class="attachment-mail">
                             @foreach($datas as $data)
	                          <div class="panel" style="width:282px;float:left;margin:12px;margin-top:0px;background-color:#EEEEEE;">
	                              <div class="panel-body">
	                                   <div class="pull-left">
	                                       <img style="width:96px;" class="thumb" src="{{ route('getThumbImg', $data->user_id) }}" />
	                                   </div>
	                                   <div class="media-body">
	                                      <div style="font-size:12px;">{{ $data->name }}</div>
	                                      <div style="font-size:12px;">{{ $data->email }}</div>
	                                      <div style="font-size:12px;">{{ substr($data->created_at,0,10) }}</div>
	                                   </div>
	                              </div>
	                              <div class="panel-footer custom-trq-footer">
	                              	  <a class="btn btn-success " href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}">个人主页</a>
	                              </div>
	                          </div>
			                  @endforeach()
			                  <div class="paginate" style="text-align:center;">{{ $datas->links() }}</div>
                        </div>
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
@section('js')
@parent
<script>
$(function () { 
	$("[data-toggle='popover']").popover();
});
</script>
@stop
@endsection
