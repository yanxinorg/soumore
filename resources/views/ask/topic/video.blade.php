@extends('layouts.ask')
@section('content')
<?php
use App\Models\Common\AttentionModel;
?>
<style>
	li {
		list-style-type:none;
	}
</style>
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
									<li ><a href="{{ URL::action('Front\TopicController@question', ['id'=>$tid]) }}" >问答<span class="badge">{{ $countquestions }}</span></a></li>
    								<li class="active"><a href="{{ URL::action('Front\TopicController@video', ['id'=>$tid]) }}" >视频<span class="badge">{{ $countvideos }}</span></a></li>
								</ul>
								<!-- end tab 切换 -->
							</div>
						</div>
						<!-- tab 切换内容 -->
						<div class="aw-user-center-tab">
							<div class="tab-content">
								<div class="tab-pane active" >
									<div class="aw-mod">
										<div class="mod-head">　</div>
										<div class="mod-body">
											<div class="row">
												@foreach($videos as $video )
													<div class="col-md-3"  style="margin: 0px auto;margin-bottom: 24px;text-align: center">
														<a class="img aw-border-radius-5" href="{{ URL::action('Front\VideoController@detail', ['id'=>$video->id]) }}">
															<img style="width:180px;height: 120px;" src="{{ $video->thumb }}" alt="{{ $video->title }}">
														</a>
														<li style="padding-top: 10px;" ><a class="text" href="{{ URL::action('Front\VideoController@detail', ['id'=>$video->id]) }}">{{ str_limit($video->title,24) }}</a></li>
														<li class="text-color-999"><span>发布时间：{{ substr($video->created_at,0,11) }}</span></li>
													</div>
												@endforeach()
											</div>
										</div>
										<div class="paginate" style="text-align:center;">{!! $videos->appends(array('id'=>$tid))->render() !!}</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end tab 切换内容 -->
					</div>
				</div>

				<!-- 侧边栏 -->
				<div class="col-sm-12 col-md-3 aw-side-bar hidden-xs">
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
				</div>
				<!-- end 侧边栏 -->
			</div>
		</div>
	</div>
</div>
@endsection