@extends('layouts.wenda')
@section('content')
<style>
.mail-list{
	height:auto;
}
.profile-pic span{
	font-size:128px;
	line-height:128px;
	text-align:center;
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
.panel .panel-body .p-info{
	font-size:12px;
	overflow:hidden;
}
</style>
<?php 
use App\Models\Common\AreaModel;
?>
      <div class="wrapper">
      	<div class="directory-info-row">
            <div class="row">
                <div class="col-md-2">
                    
                </div>
                <div class="col-md-8">
                   	<section class="mail-box-info">
	                    <header class="header">
	                        <div class="compose-btn pull-left">
	                        	<a href="{{ URL::action('Front\SearchController@post', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">文章</button></a>
								<a href="{{ URL::action('Front\SearchController@wenda', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">问答</button></a>
								<a href="{{ URL::action('Front\SearchController@topic', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">话题</button></a>
								<a href="{{ URL::action('Front\SearchController@user', ['wd'=>$wd]) }}"><button class="btn btn-success btn-sm">用户</button></a>
	                        </div>
	                        <div class="btn-toolbar">
	                            <h4 class="pull-right"></h4>
	                        </div>
	                    </header>
		                <section class="mail-list">
		                 	<div class="attachment-mail">
                            <ul>
                            @foreach($datas as $data)
                                <li title="<span style='font-size:12px;text-align:center;'>用户信息</span>"  data-container="body" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" 
                                data-content="<ul class='p-info' style='width:256px;'>
		                                        @if(!empty($data->name))
		                                    	<li>
		                                            <div class='title' style='font-size:12px;'>用户名</div>
		                                            <div class='desk' style='font-size:12px;'>{{ $data->name }}</div>
		                                        </li>
		                                       	@endif
		                                       	@if(!empty($data->realname))
		                                        <li>
		                                            <div class='title' style='font-size:12px;'>真实姓名</div>
		                                            <div class='desk' style='font-size:12px;'>{{ $data->realname }}</div>
		                                        </li>
		                                        @endif
		                                        @if(!empty($data->email))
		                                        <li>
		                                            <div class='title' style='font-size:12px;'>邮箱</div>
		                                            <div class='desk' style='font-size:12px;'>{{ $data->email }}</div>
		                                        </li>
		                                        @endif
		                                        @if(!empty($data->created_at))
		                                        <li>
		                                            <div class='title' style='font-size:12px;'>注册时间</div>
		                                            <div class='desk' style='font-size:12px;'>{{ substr($data->created_at,0,10) }}</div>
		                                        </li>
		                                        @endif
		                                        @if(!empty($data->mobile))
		                                        <li>
		                                            <div class='title' style='font-size:12px;'>手机号</div>
		                                            <div class='desk' style='font-size:12px;'>{{ $data->mobile }}</div>
		                                        </li>
		                                        @endif
		                                        @if(!empty($data->birthday))
		                                        <li>
		                                            <div class='title' style='font-size:12px;'>生日</div>
		                                            <div class='desk' style='font-size:12px;'>{{ $data->birthday }}</div>
		                                        </li>
		                                        @endif
		                                        @if(!empty($data->site))
		                                        <li>
		                                            <div class='title' style='font-size:12px;'>个人主页</div>
		                                            <div class='desk' style='font-size:12px;'><a href=''>{{ $data->site }}</a></div>
		                                        </li>
		                                        @endif
		                                        @if(!empty($data->qq))
		                                        <li>
		                                            <div class='title' style='font-size:12px;'>QQ</div>
		                                            <div class='desk' style='font-size:12px;'>{{ $data->qq }}</div>
		                                        </li>
		                                        @endif
		                                        @if(!empty($data->weixin))
		                                        <li>
		                                            <div class='title' style='font-size:12px;'>微信</div>
		                                            <div class='desk' style='font-size:12px;'>{{ $data->weixin }}</div>
		                                        </li>
		                                        @endif
		                                        @if(!empty($data->graduateschool))
		                                        <li>
		                                            <div class='title' style='font-size:12px;'>毕业院校</div>
		                                            <div class='desk' style='font-size:12px;'>{{ $data->graduateschool }}</div>
		                                        </li>
		                                        @endif
		                                        @if(!empty($data->province))
		                                        <li>
		                                            <div class='title' style='font-size:12px;'>所在城市</div>
		                                            <div class='desk' style='font-size:12px;'>
		                                            @php echo (AreaModel::where('id',$data->province)->pluck('name'))[0]; @endphp,
		                                            @php echo (AreaModel::where('id',$data->city)->pluck('name'))[0]; @endphp市
		                                            </div>
		                                        </li>
		                                        @endif
		                                        @if(!empty($data->company))
		                                        <li>
		                                            <div class='title' style='font-size:12px;'>公司名称</div>
		                                            <div class='desk' style='font-size:12px;'>{{ $data->company }}</div>
		                                        </li>
		                                        @endif
		                                        @if(!empty($data->occupation))
		                                        <li>
		                                            <div class='title' style='font-size:12px;'>职业</div>
		                                            <div class='desk' style='font-size:12px;'>{{ $data->occupation }}</div>
		                                        </li>
		                                        @endif
		                                        @if(!empty($data->bio))
		                                        <li>
		                                            <div class='title' style='font-size:12px;'>个性签名</div>
		                                            <div class='desk' style='font-size:12px;'>{{ $data->bio }}</div>
		                                        </li>
		                                        @endif
		                                      </ul>">
	                                <a class="atch-thumb" target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->id]) }}">
	                                	<img src="{{ route('getThumbImg', $data->id) }}">
	                                </a>
                                </li>
                            @endforeach()
                            </ul>
                            </div>
	                    </section>
	                </section>
                </div>
                <div class="col-md-2">
                    <div class="row">
                       
                    </div>
                </div>
            </div>
     	</div>
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
