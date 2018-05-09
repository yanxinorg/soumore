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
										<li class="active"><a href="{{ URL::action('Front\SearchController@topic', ['wd'=>$wd]) }}" >话题</a></li>
										<li ><a href="{{ URL::action('Front\SearchController@wenda', ['wd'=>$wd]) }}" >问题</a></li>
										<li ><a href="{{ URL::action('Front\SearchController@post', ['wd'=>$wd]) }}" >文章</a></li>
										<li ><a  href="{{ URL::action('Front\SearchController@index', ['wd'=>$wd]) }}">全部</a></li>
										<h2 class="hidden-xs"><p>搜索 - <span id="aw-search-type">全部</span></p></h2>
									</ul>
								</div>
							</div>
							<div class="mod-body">
								<div class="tab-content">
									<div class="tab-pane active">
										<div id="search_result">
											@foreach($datas as $data)
											<div class="aw-item">
												<a href="{{ URL::action('Front\TopicController@detail', ['id'=>$data->id]) }}" class="aw-topic-img"><img style="width: 50px;" src="{{ $data->thumb }}" ></a>
												<p class="aw-title">
													<span class="topic-tag">
														<a href="{{ URL::action('Front\TopicController@detail', ['id'=>$data->id]) }}" class="text" >
															<span class="aw-text-color-red">{{ $data->name }}</span>
														</a>
													</span>
												</p>
												<p class="aw-text-color-666"><i class="icon icon-topic"></i>{{ $data->watchs }}个关注</p>
											</div>
											@endforeach()
										</div>
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
