@extends('layouts.ask')
@section('content')
	<div class="aw-container-wrap">
		<div class="container">
			<div class="row">
				<div class="aw-content-wrap clearfix">
					<div class="col-sm-12 aw-main-content">
						<div class="aw-mod aw-mod-search-result">
							<div class="mod-head">
								<div class="tabbable">
									<ul class="nav nav-tabs aw-nav-tabs active" id="list_nav">
										<li><a href="{{ URL::action('Front\SearchController@user', ['wd'=>$wd]) }}" >用户</a></li>
										<li><a href="{{ URL::action('Front\SearchController@topic', ['wd'=>$wd]) }}" >话题</a></li>
										<li><a href="{{ URL::action('Front\SearchController@wenda', ['wd'=>$wd]) }}" >问题</a></li>
										<li class="active"><a href="{{ URL::action('Front\SearchController@post', ['wd'=>$wd]) }}" >文章</a></li>
										<li ><a  href="{{ URL::action('Front\SearchController@index', ['wd'=>$wd]) }}">全部</a></li>
										<h2 class="hidden-xs"><p>搜索 - <span id="aw-search-type">全部</span></p></h2>
									</ul>
								</div>
							</div>
							<div class="mod-body">
								<div class="tab-content">
									<div class="tab-pane active">
										<div class="mod-body">
											<div class="aw-common-list">
												@foreach($datas as $data)
													<div class="aw-item article" >
														<a class="aw-user-name hidden-xs" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" rel="nofollow"><img src="{{ $data->avator }}-sm_thumb_middle" /></a>
														<div class="aw-question-content">
															<h4><a href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ $data->title }}</a></h4>
															<p>
																<span class="text-color-999">{{ $data->comments }} 个评论 • {{ $data->hits }} 次浏览 • {{ $data->created_at }}</span>
																<span class="text-color-999 related-topic collapse"> • 来自相关话题</span>
															</p>
														</div>
													</div>
												@endforeach()
												<div class="paginate" style="text-align:center;">{!! $datas->appends(array('wd'=>$wd))->render() !!}</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
