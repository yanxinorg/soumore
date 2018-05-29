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
									<span class="pull-right aw-setting-inbox hidden-xs"><a class="text-color-999" href="http://ask.com/?/account/setting/privacy/#!inbox"><i class="icon icon-setting"></i> 私信设置</a></span>
									私信							</h2>
							</div>
							<div class="mod-body aw-feed-list">
								<section class="mail-list">
									@foreach($datas as $data)
										<div class="container-fluid" style="border-bottom:1px solid #D1D5E1;margin:12px 0px;">
											<div class="row-fluid" >
												<div class="span12" >
													<div class="media" style="margin-bottom: 12px;">
														<a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->id]) }}" class="pull-left"><img style="width:48px;" src="{{ $data->avator }}" class="media-object" /></a>
														<div class="media-body">
															<div style="line-height:10px;margin-bottom:8px;"><span style="font-size: 14px;"><a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->id]) }}">{{ $data->username }}</a></span><span style="margin-left:24px;font-size:12px;">{{ $data->created_at }}</span></div>
															<h6 class="media-heading" style="font-size:10px;">{{ $data->content }}</h6>
															<a style="font-size:10px;"href="{{ URL::action('Front\PersonController@letterDetail', ['from_user_id'=>$data->from_user_id,'to_user_id'=>$data->to_user_id]) }}" class="pull-right">展开</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									@endforeach()
									<div class="paginate" style="text-align:center;">{!! $datas->links() !!}</div>
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