@extends('layouts.ask')
@section('content')
	<div class="aw-container-wrap">
		<div class="container">
			<div class="row">
				<div class="aw-content-wrap clearfix">
					<div class="col-sm-12 col-md-9 aw-main-content">
						<div class="aw-mod aw-inbox-read">
							<div class="mod-head common-head">
								<h2>
									<a href="{{ url('/person/letter') }}" class="pull-right">返回私信列表 »</a>私信对话：admin	</h2>
							</div>
							<div class="mod-body">
								<!-- 私信内容输入框　-->
								<form action="" method="post" id="recipient_form">
									<input type="hidden" name="post_hash" value="">
									<input type="hidden" name="recipient" value="admin">
									<a href="" data-id="4" class="aw-user-img aw-border-radius-5"><img src="http://ask.com/static/common/avatar-mid-img.png" alt=""></a>
									<textarea rows="3" class="form-control message" placeholder="想要对ta说点什么?" type="text" name="message"></textarea>
									<p>
										<a class="btn btn-mini btn-success" href="" onclick="">发送</a>
									</p>
								</form>
								<!-- end 私信内容输入框 -->
							</div>
							<div class="mod-footer">
								<!-- 私信内容列表 -->
								<a name="contents"></a>
								<ul>
									@foreach($datas as $data)
										@if($data->from_user_id == Auth::id())
											<li class="active">
												<a href="" data-id="4" class="aw-user-img aw-border-radius-5"><img src="{{ $data->avator }}" ></a>
												<div class="aw-item">
													<p><a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->from_user_id]) }}">我</a>: {{ $data->content }}</p>
													<p class="text-color-999">{{ $data->created_at }}</p>
													<i class="i-private-replay-triangle"></i>
												</div>
											</li>
										@else
											<li>
												<a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->from_user_id]) }}" class="aw-user-img aw-border-radius-5"><img src="{{ $data->avator }}" ></a>
												<div class="aw-item">
													<p><a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->from_user_id]) }}">{{ $data->username }}</a>: {{ $data->content }}</p>
													<p class="text-color-999">
														<span class="pull-right aw-replay"><a href="javascript:;" onclick="">回复</a></span>{{ $data->created_at }}</p>
													<i class="i-private-replay-triangle"></i>
												</div>
											</li>
											<a class="pull-left" ></a>
										@endif
									@endforeach()
								</ul>
								<!-- end 私信内容列表 -->
							</div>
						</div>
					</div>
					<!-- 侧边栏 -->
					<div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm">
						<div class="aw-mod side-nav">
							<div class="mod-body">
								<ul>
									<li><a href="http://ask.com/?/home/#all" rel="all"><i class="icon icon-home"></i>最新动态</a></li>
									<li><a href="http://ask.com/?/home/#draft_list__draft" rel="draft_list__draft"><i class="icon icon-draft"></i>我的草稿</a></li>
									<li><a href="http://ask.com/?/favorite/"><i class="icon icon-favor"></i>我的收藏</a></li>
									<li><a href="http://ask.com/?/home/#all__focus" rel="all__focus"><i class="icon icon-check"></i>我关注的问题</a></li>
									<li><a href="http://ask.com/?/home/#focus_topic__focus" rel="focus_topic__focus"><i class="icon icon-mytopic"></i>我关注的话题</a></li>
									<li><a href="http://ask.com/?/home/#invite_list__invite" rel="invite_list__invite"><i class="icon icon-invite"></i>邀请我回复的问题</a></li>
								</ul>
							</div>
						</div>

						<div class="aw-mod side-nav">
							<div class="mod-body">
								<ul>
									<li><a href="http://ask.com/?/topic/"><i class="icon icon-topic"></i>所有话题</a></li>
									<li><a href="http://ask.com/?/people/"><i class="icon icon-user"></i>所有用户</a></li>
									<li><a href="http://ask.com/?/invitation/"><i class="icon icon-inviteask"></i>邀请好友加入 <em class="badge">10</em></a></li>
								</ul>
							</div>
						</div>				</div>
					<!-- end 侧边栏 -->
				</div>
			</div>
		</div>
	</div>
@endsection