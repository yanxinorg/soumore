@extends('layouts.ask')
@section('content')
<?php
use App\Models\Common\AttentionModel;
?>
<div class="aw-container-wrap">
	<div class="container1">
		<div class="row">
			<div class="col-sm-12">
				<div class="aw-global-tips"></div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="aw-content-wrap clearfix">
				<div class="col-sm-12 col-md-9 aw-main-content">
					<div class="aw-mod aw-topic-detail-title">
						<div class="mod-body">
							<img style="width:76px;height: 76px;" src="{{ $datas->thumb }}" alt="地方">
							<h2 style="margin-left: 12px;">
								<span>{{ $datas->name }}</span>
								<p class="text-color-999">
									<span>{{ $datas->watchs }} 个关注</span>
								</p>
							</h2>
							<div class="aw-topic-operate text-color-999">
								@if( AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$datas->id,'source_type'=>'3'])->exists())
									<a href="{{ URL::action('Front\PersonController@topicCancel', ['tid'=>$datas->id]) }}" class="follow btn btn-normal btn-success active" ><span>取消关注</span></a>
								@else
									<a href="{{ URL::action('Front\PersonController@topicCreate', ['tid'=>$datas->id]) }}" class="follow btn btn-normal btn-success" ><span>关注</span></a>
								@endif
							</div>
						</div>
					</div>

					<div class="aw-mod aw-topic-list-mod">
						<div class="mod-head">
							<div class="tabbable">
								<!-- tab 切换 -->
								<ul class="nav nav-tabs aw-nav-tabs hidden-xs">
									<li ><a href="{{ URL::action('Front\TopicController@detail', ['id'=>$tid]) }}" >关于话题</a></li>
									<li ><a href="{{ URL::action('Front\TopicController@post', ['id'=>$tid]) }}" >文章<span class="badge">{{ $countposts }}</span></a></li>
									<li class="active"><a href="{{ URL::action('Front\TopicController@question', ['id'=>$tid]) }}" >问答<span class="badge">{{ $countquestions }}</span></a></li>
    								<li><a href="{{ URL::action('Front\TopicController@video', ['id'=>$tid]) }}" >视频<span class="badge">{{ $countvideos }}</span></a></li>
									<div class="aw-search-bar pull-right hidden-xs">
										<i class="icon icon-search"></i>
										<input type="text" id="question-input" class="search-query form-control" placeholder="搜索...">
										<div class="aw-dropdown">
											<p class="title">没有找到相关结果</p>
											<ul class="aw-dropdown-list"></ul>
										</div>
									</div>
								</ul>
								<!-- end tab 切换 -->
							</div>
						</div>

						<div class="aw-user-center-tab">
							<!-- tab 切换内容 -->
							<div class="tab-pane active" >
								<div class="aw-mod">
									<div class="mod-body" >
										<div class="aw-common-list" >
											<div style="clear: both;"></div>
											@foreach($questions as $data)
												<div class="aw-item article">
													<a class="aw-user-name hidden-xs" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" rel="nofollow"><img src="{{ $data->avator }}" alt="{{ $data->author }}"></a>
													<div class="aw-question-content">
														<h4><a href="{{ URL::action('Front\QuestionController@detail', ['id'=>$data->question_id]) }}">{{ $data->title }}</a></h4>
														<p>
															<a class="aw-question-tags" href="{{ URL::action('Front\QuestionController@cate', ['cid'=>$data->cate_id]) }}">{{ $data->cate_name  }}</a>
															<a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" class="aw-user-name">{{ $data->author }}</a> <span class="text-color-999">发表了文章 • {{ $data->comments }}个评论 • {{ $data->views }} 次浏览 • {{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
															<span class="text-color-999 related-topic collapse"> • 来自相关话题</span>
														</p>
													</div>
												</div>
											@endforeach()
											<div class="paginate" style="text-align:center;">{!! $questions->appends(array('id'=>$tid))->render() !!}</div>
										</div>
									</div>
								</div>
							</div>
							<!-- end tab 切换内容 -->
						</div>
					</div>
				</div>

				<!-- 侧边栏 -->
				<div class="col-sm-12 col-md-3 aw-side-bar hidden-xs">
					<!-- 话题描述 -->
					<div class="aw-mod aw-text-align-justify">
						<div class="mod-head">
							<h3>话题描述</h3>
						</div>
						<div class="mod-body">
							<a href="http://ask.com/?/topic/edit/2" class="icon-inverse"><i class="icon icon-edit"></i> 添加描述</a>
						</div>
					</div>
					<!-- end 话题描述 -->
					<!-- xx人关注该话题 -->
					<div class="aw-mod topic-status">
						<div class="mod-head">
							<h3>{{ $attenCount }}人关注该话题</h3>
						</div>
						<div class="mod-body">
							<div id="focus_users" class="aw-border-radius-5">
								@foreach($attenUsers as $user)
								<a href="{{ URL::action('Front\HomeController@index', ['uid'=>$user->user_id]) }}"><img src="{{ $user->avator }}" alt="{{ $user->name }}"></a>
								@endforeach()
							</div>
						</div>
					</div>
					<!-- end xx人关注该话题 -->
					<div class="aw-mod">
						<div class="mod-head">
							<h3>管理</h3>
						</div>
						<div class="mod-body">
							<ul>
								<li><a href="http://ask.com/?/topic/edit/2">编辑话题</a></li>
								<li><a href="http://ask.com/?/topic/manage/2">管理话题</a></li>
								<li><a href="javascript:;" onclick="">锁定话题</a></li>
								<li><a href="javascript:;" onclick="">删除话题</a></li>
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