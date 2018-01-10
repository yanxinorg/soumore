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
      <div class="wrapper">
      	<div class="directory-info-row">
            <div class="row">
                
                <div class="col-md-10 col-sm-9">
                   	<section class="mail-box-info">
	                    <header class="header">
	                        <div class="compose-btn pull-left">
	                        	@if($uid == Auth::id())
	                        	   <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$uid]) }}"><button class="btn btn-default btn-sm">我的动态</button></a>
								   <a href="{{ URL::action('Front\HomeController@post', ['uid'=>$uid]) }}"><button class="btn btn-success btn-sm">我的文章</button></a>
								   <a href="{{ URL::action('Front\HomeController@question', ['uid'=>$uid]) }}"><button class="btn btn-default btn-sm">我的提问</button></a>
		                           <a href="{{ URL::action('Front\HomeController@answer', ['uid'=>$uid]) }}"><button class="btn btn-default btn-sm">我的回答</button></a>
		                           <a href="{{ URL::action('Front\HomeController@fans', ['uid'=>$uid]) }}"><button class="btn btn-default btn-sm">我的粉丝</button></a>
	                        	@else
	                        	   <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$uid]) }}"><button class="btn btn-default btn-sm">他的动态</button></a>
								   <a href="{{ URL::action('Front\HomeController@post', ['uid'=>$uid]) }}"><button class="btn btn-success btn-sm">他的文章</button></a>
								   <a href="{{ URL::action('Front\HomeController@question', ['uid'=>$uid]) }}"><button class="btn btn-default btn-sm">他的提问</button></a>
		                           <a href="{{ URL::action('Front\HomeController@answer', ['uid'=>$uid]) }}"><button class="btn btn-default btn-sm">他的回答</button></a>
		                           <a href="{{ URL::action('Front\HomeController@fans', ['uid'=>$uid]) }}"><button class="btn btn-default btn-sm">他的粉丝</button></a>
	                        	@endif
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
														<span>{{ $data->created_at }}</span>
														<h6 class="media-heading" ><a target="_blank" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ str_limit($data->title,170) }}</a></h6>
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
														<span><a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}">{{ $data->author }}</a></span>
														<span>{{ $data->created_at }}</span>
														<h6 class="media-heading"><a target="_blank" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ str_limit($data->title,170) }}</a></h6>
													</div>
													<div class="excerpt">{{ str_limit($data->excerpt,316) }}</div>
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
                </div>
                <div class="col-md-2 col-sm-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="profile-pic text-center">
                                        <img src="{{ route('getThumbImg',$uid) }}">
                                    </div>
                                 @if(Auth::id() != $uid)
                                	@if($islooked)
	                                	<a class="btn p-follow-btn pull-right" href="{{ URL::action('Front\AttentionController@cancelUser', ['uid'=>$uid]) }}">取消关注</a>
	                                @else
	                                	<a class="btn p-follow-btn pull-right" href="{{ URL::action('Front\AttentionController@user', ['uid'=>$uid]) }}">关注</a>
	                                @endif
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel">
                               <div class="panel-body">
                                    <ul class="p-info">
                                    	<li>
                                            <div class="title">用户名</div>
                                            <div class="desk">{{ $userinfo->name }}</div>
                                        </li>
                                        @if(!empty($userinfo->realname))
                                        <li>
                                            <div class="title">真实姓名</div>
                                            <div class="desk">{{ $userinfo->realname }}</div>
                                        </li>
                                        @endif
                                        <li>
                                            <div class="title">邮箱</div>
                                            <div class="desk">{{ $userinfo->email }}</div>
                                        </li>
                                        <li>
                                            <div class="title">注册时间</div>
                                            <div class="desk">{{ $userinfo->created_at }}</div>
                                        </li>
                                        @if(!empty($userinfo->mobile))
                                        <li>
                                            <div class="title">手机号</div>
                                            <div class="desk">{{ $userinfo->mobile }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->birthday))
                                        <li>
                                            <div class="title">生日</div>
                                            <div class="desk">{{ $userinfo->birthday }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->site))
                                        <li>
                                            <div class="title">个人主页</div>
                                            <div class="desk"><a href="{{ $userinfo->site }}" target="_blank">{{ $userinfo->site }}</a></div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->qq))
                                        <li>
                                            <div class="title">QQ</div>
                                            <div class="desk">{{ $userinfo->qq }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->weixin))
                                        <li>
                                            <div class="title">微信</div>
                                            <div class="desk">{{ $userinfo->weixin }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->graduateschool))
                                        <li>
                                            <div class="title">毕业院校</div>
                                            <div class="desk">{{ $userinfo->graduateschool }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($province))
                                        <li>
                                            <div class="title">所在城市</div>
                                            <div class="desk">{{ $province }},{{ $city }}市</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->company))
                                        <li>
                                            <div class="title">公司名称</div>
                                            <div class="desk">{{ $userinfo->company }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->occupation))
                                        <li>
                                            <div class="title">职业</div>
                                            <div class="desk">{{ $userinfo->occupation }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->bio))
                                        <li>
                                            <div class="title">个性签名</div>
                                            <div class="desk">{{ $userinfo->bio }}</div>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
     	</div>
     </div>
@endsection
