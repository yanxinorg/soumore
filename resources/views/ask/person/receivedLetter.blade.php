@extends('layouts.ask')
@section('content')
	<div class="aw-container-wrap">
		<div class="container">
			<div class="row">
				<div class="aw-content-wrap clearfix">
					<div class="col-sm-12 col-md-9 aw-main-content">
						<div class="aw-mod aw-inbox">
							<div class="mod-head common-head">
								<h2>
									<a href="{{ url('/person/sendLetter') }}"  class="pull-right btn btn-mini btn-success">新私信</a>
									私信
								</h2>
							</div>
							<div class="mod-body aw-feed-list">
								<section class="mail-list">
									@foreach($datas as $data)
										<div class="aw-item  @if($data['countNotice']) active @endif" style="border-bottom:1px solid #D1D5E1;margin:12px 0px;">
											<div class="row-fluid" >
												<div class="span12" >
													<div class="media" style="margin-bottom: 12px;">
														<a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data[0]->id]) }}" class="pull-left"><img style="width:48px;" src="{{ $data[0]->avator }}" class="media-object" /></a>
														<div class="media-body">
															<div style="line-height:10px;margin-bottom:8px;"><span style="font-size: 14px;"><a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data[0]->id]) }}">{{ $data[0]->username }}</a></span><span style="margin-left:24px;font-size:12px;">{{ $data[0]->created_at }}</span></div>
															<h6 class="media-heading" style="font-size:10px;">{{ $data[0]->content }}</h6>
                                                            <span class="pull-right">
                                                                @if($data['countNotice'])
                                                                <a href="{{ URL::action('Front\PersonController@letterDetail', ['from_user_id'=>$data[0]->from_user_id,'to_user_id'=>$data[0]->to_user_id]) }}" >有 {{ $data['countNotice'] }} 条新回复</a> &nbsp;
                                                                @endif
                                                                @if($data['countMessage'])
                                                                    <a href="{{ URL::action('Front\PersonController@letterDetail', ['from_user_id'=>$data[0]->from_user_id,'to_user_id'=>$data[0]->to_user_id]) }}" >共 {{ $data['countMessage'] }} 条消息</a> &nbsp;
                                                                @endif
                                                            </span>
														</div>
													</div>
												</div>
											</div>
										</div>
									@endforeach()
								</section>
							</div>
							<div class="mod-footer">
							</div>
						</div>
					</div>
					<!-- 侧边栏 -->
					<div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm">

						<div class="aw-mod side-nav">
							<div class="mod-body">
								<ul>
									<li><a href="{{ url('/dynamic') }}" ><i class="icon icon-home"></i>最新动态</a></li>
									<li><a href="{{ URL::action('Front\PersonController@post') }}" ><i class="icon icon-home"></i>我的文章</a></li>
									<li><a href="{{ url('/person/answer') }}"  ><i class="icon icon-home"></i>我的问答</a></li>
									<li><a href="{{ url('/person/video') }}"><i class="icon icon-draft"></i>我的视频</a></li>
									<li><a href="{{ url('/person/postCollect') }}"><i class="icon icon-favor"></i>我的收藏</a></li>
									<li><a href="{{ url('/person/topicAttention') }}" rel="focus_topic__focus"><i class="icon icon-mytopic"></i>我的话题</a></li>
								</ul>
							</div>
						</div>

						<div class="aw-mod side-nav">
							<div class="mod-body">
								<ul>
									<li><a href="{{ url('/topic') }}"><i class="icon icon-topic"></i>所有话题</a></li>
									<li><a href="{{ url('/user/hot') }}"><i class="icon icon-user"></i>所有用户</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- end 侧边栏 -->
				</div>
			</div>
		</div>
	</div>
@endsection