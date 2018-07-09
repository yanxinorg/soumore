@extends('layouts.ask')
@section('content')
<style>
	.aw-mod-search-result .aw-item {
		position: relative;
		padding: 14px 106px 14px 0px;
		border-bottom: 1px solid #f5f5f5;
	}
</style>
	<div class="aw-container-wrap">
		<div class="container1">
			<div class="row">
				<div class="aw-content-wrap clearfix">
					<div class="col-sm-12 aw-main-content">
						<div class="aw-mod aw-mod-search-result">
							<div class="mod-head">
								<div class="tabbable">
									<ul class="nav nav-tabs aw-nav-tabs active" id="list_nav">
										<li ><a  href="{{ URL::action('Front\SearchController@video', ['wd'=>$wd]) }}">视频<span class="badge">{{ $videoCount }}</span></a></li>
										<li><a href="{{ URL::action('Front\SearchController@user', ['wd'=>$wd]) }}" >用户<span class="badge">{{ $userCount }}</span></a></li>
										<li><a href="{{ URL::action('Front\SearchController@topic', ['wd'=>$wd]) }}" >话题<span class="badge">{{  $tagCount }}</span></a></li>
										<li><a href="{{ URL::action('Front\SearchController@wenda', ['wd'=>$wd]) }}" >问答<span class="badge">{{ $questionCount }}</span></a></li>
										<li ><a href="{{ URL::action('Front\SearchController@post', ['wd'=>$wd]) }}" >文章<span class="badge">{{ $postCount }}</span></a></li>
										<li class="active"><a href="{{ URL::action('Front\SearchController@torrent', ['wd'=>$wd]) }}" >资源<span class="badge">{{ $btCount }}</span></a></li>
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
														<div class="aw-question-content">
															<h4><a href="{{ URL::action('Front\TorrentController@detail', ['id'=>$data->id]) }}">{{ $data->name }}</a></h4>
															<p>
																<span class="text-color-999">{{ $data->requests }} 次下载 • {{ $data->create_time }}</span>
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
