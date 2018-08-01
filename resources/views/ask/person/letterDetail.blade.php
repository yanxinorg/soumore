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
									<a href="{{ url('/person/letter') }}" class="pull-right">返回私信列表 »</a>私信对话：{{ $toUser[0]->name }}	</h2>
							</div>
							<div class="mod-body">
								<!-- 私信内容输入框　-->
								<form method="post" action="{{ url('/person/storeLetter') }}" >
									@if ($errors->has('error'))
										<div class="form-group">
											<div class="col-md-12 col-sm-12">
												<div class="alert alert-error ">
													{{ $errors->first('error') }}
												</div>
											</div>
										</div>
									@endif
									{{ csrf_field() }}
									<div class="form-group" hidden>
										<input name="from_user_id" value="{{ Auth::id() }}" class="form-control" >
									</div>
									<div class="form-group" hidden>
										<div class="col-lg-12">
											<input name="to_user_id" value="{{ $toUser[0]->id }}" class="form-control" >
										</div>
									</div>
									<a href="{{ URL::action('Front\HomeController@index', ['uid'=>$authUser->id]) }}" data-id="4" class="aw-user-img aw-border-radius-5"><img src="{{ $authUser->avator }}" ></a>
									<textarea rows="3" class="form-control message" placeholder="私信内容?" type="text" name="content"></textarea>
									<p>
										<input class="btn btn-mini btn-success" type="submit" value="发送" />
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
											<li >
												<a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->from_user_id]) }}" data-id="4" class="aw-user-img aw-border-radius-5"><img src="{{ $data->a_avator }}" ></a>
												<div class="aw-item">
													<p><a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->from_user_id]) }}">我</a>：<span class="pull-right">{{ $data->created_at }}</span></p>
													<p class="text-color-999"  style="font-size: 14px;">{{ $data->content }}</p>
													<i class="i-private-replay-triangle"></i>
												</div>
											</li>
										@else
											<li class="active">
												<a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->from_user_id]) }}" class="aw-user-img aw-border-radius-5"><img src="{{ $data->a_avator }}" ></a>
												<div class="aw-item">
													<p><a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->from_user_id]) }}">{{ $data->a_username }}</a>：<span class="pull-right">{{ $data->created_at }}</span></p>
													<p class="text-color-999" style="font-size: 14px;">{{ $data->content }}</p>
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
									<li><a href="{{ URL::action('Front\PersonController@post', ['status'=>'1']) }}"  ><i class="icon icon-home"></i>我的文章</a></li>
									<li><a href="{{ url('/person/answer') }}" ><i class="icon icon-home"></i>我的问答</a></li>
									<li><a href="{{ URL::action('Front\PersonController@post', ['status'=>'0']) }}" ><i class="icon icon-draft"></i>我的草稿</a></li>
									<li><a href="{{ url('/person/postCollect') }}"><i class="icon icon-favor"></i>我的收藏</a></li>
									<li><a href="{{ url('/person/topicAttention') }}" rel="focus_topic__focus"><i class="icon icon-mytopic"></i>我关注的话题</a></li>
									<li><a href="" rel="invite_list__invite"><i class="icon icon-invite"></i>邀请我回复的问题</a></li>
								</ul>
							</div>
						</div>

						<div class="aw-mod side-nav">
							<div class="mod-body">
								<ul>
									<li><a href="{{ url('/topic') }}"><i class="icon icon-topic"></i>所有话题</a></li>
									<li><a href="http://ask.com/?/people/"><i class="icon icon-user"></i>所有用户</a></li>
									<li><a href="http://ask.com/?/invitation/"><i class="icon icon-inviteask"></i>邀请好友加入 <em class="badge">10</em></a></li>
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