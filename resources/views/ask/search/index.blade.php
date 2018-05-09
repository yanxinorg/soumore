@extends('layouts.ask')
@section('content')
	<div class="aw-container-wrap">
		<div class="container1">
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
										<li><a href="{{ URL::action('Front\SearchController@post', ['wd'=>$wd]) }}" >文章</a></li>
										<li class="active"><a href="{{ URL::action('Front\SearchController@index', ['wd'=>$wd]) }}">全部</a></li>
										<h2 class="hidden-xs"><p>搜索 - <span id="aw-search-type">全部</span></p></h2>
									</ul>
								</div>
							</div>
							<div class="mod-body">
								<div class="tab-content">
									<div class="tab-pane active">
										<div id="search_result">
											<div class="aw-item">
												<a href="" class="aw-topic-img" data-id="6"><img src="./222 - 搜索 - WeCenter_files/topic-mid-img.png" alt=""></a>
												<p class="aw-title"><span class="topic-tag"><a href="http://ask.com/?/topic/2222" class="text" target="_blank"><span class="aw-text-color-red">222</span>2</a></span></p>
												<p class="aw-text-color-666"><i class="icon icon-topic"></i> 1 个讨论</p>
											</div>
										</div>
										<!-- 加载更多内容 -->
										<a class="aw-load-more-content" id="search_result_more" data-page="2">
											<span>更多...</span>
										</a>
										<!-- end 加载更多内容 -->
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
