@extends('layouts.ask')
@section('content')
	<style>
		.aw-mod-search-result .aw-item {
            width: 20%;
            float: left;
            position: relative;
			position: relative;
			padding: 14px 0px 14px 0px;
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
										<li class="active"><a href="{{ URL::action('Front\SearchController@video', ['wd'=>$wd]) }}">视频<span class="badge">{{ $videoCount }}</span></a></li>
										<li><a href="{{ URL::action('Front\SearchController@user', ['wd'=>$wd]) }}" >用户<span class="badge">{{ $userCount }}</span></a></li>
										<li><a href="{{ URL::action('Front\SearchController@topic', ['wd'=>$wd]) }}" >话题<span class="badge">{{  $tagCount }}</span></a></li>
										<li><a href="{{ URL::action('Front\SearchController@wenda', ['wd'=>$wd]) }}" >问答<span class="badge">{{ $questionCount }}</span></a></li>
										<li><a href="{{ URL::action('Front\SearchController@post', ['wd'=>$wd]) }}" >文章<span class="badge">{{ $postCount }}</span></a></li>
										<li><a href="{{ URL::action('Front\SearchController@torrent', ['wd'=>$wd]) }}" >资源<span class="badge">{{ $btCount }}</span></a></li>
										<h2 class="hidden-xs"><p>搜索 - <span id="aw-search-type">全部</span></p></h2>
									</ul>
								</div>
							</div>
							<div class="mod-body">
								<div class="tab-content">
									<div class="tab-pane active">
										@foreach($datas as $video)
											<div class="aw-item " >
												<a class="img aw-border-radius-5" href="{{ URL::action('Front\VideoController@detail', ['id'=>$video->id]) }}">
													<img style="width:180px;height: 120px;" src="{{ $video->thumb }}" alt="{{ $video->title }}">
												</a>
												<p class="clearfix" style="margin-top: 12px;">
													<a class="text" href="{{ URL::action('Front\VideoController@detail', ['id'=>$video->id]) }}">{{ str_limit($video->title,20) }}</a>
												</p>
												<p class="text-color-999">
													<span>作者：<a class="aw-user-name hidden-xs" href="{{ URL::action('Front\HomeController@index', ['uid'=>$video->user_id]) }}" rel="nofollow">{{ $video->user_id }}</a></span>
												</p>
												<p class="text-color-999">
													<span>发布时间：{{ substr($video->created_at,0,11) }}</span>
												</p>
											</div>
										@endforeach()
									</div>
                                    <div class="mod-footer clearfix">
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
@endsection
