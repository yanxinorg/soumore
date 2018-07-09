@extends('layouts.ask')
@section('content')
<div class="aw-container-wrap">
	<div class="container1" >
		<div class="row">
			<div class="aw-content-wrap clearfix">
				<div class="col-sm-12 col-md-9 aw-main-content">
					<!-- 新消息通知 -->
					<div class="aw-mod aw-notification-box collapse" id="index_notification">
						<div class="mod-head common-head">
							<h2>
								<span class="pull-right"><a href="" class="text-color-999"><i class="icon icon-setting"></i> 通知设置</a></span>
								<i class="icon icon-bell"></i>新通知<em class="badge badge-important" name="notification_unread_num">0</em>
							</h2>
						</div>
						<div class="mod-body">
							<ul id="notification_list"></ul>
						</div>
						<div class="mod-footer clearfix">
							<a href="javascript:;" onclick="" class="pull-left btn btn-mini btn-gray">我知道了</a>
							<a href="" class="pull-right btn btn-mini btn-success">查看所有</a>
						</div>
					</div>
					<!-- end 新消息通知 -->
					<!-- tab切换 -->
					<ul class="nav nav-tabs aw-nav-tabs active hidden-xs">
                        <li><a href="{{ url('/post/recom') }}">推荐</a></li>
						<li><a href="{{ url('/post/hot') }}">热门</a></li>
						<li class="active"><a href="{{ url('/post') }}">最新</a></li>
						<h2 class="hidden-xs"><i class="icon icon-download"></i>资源</h2>
					</ul>
					<!-- end tab切换 -->
					<div class="aw-mod aw-explore-list">
                    		<div class="mod-body">
							<div class="aw-common-list">
								@foreach($datas as $data)
									<div class="aw-item article" style="min-height: 68px;padding:12px 0px;" >
										<div class="aw-question-content">
											<h4><a href="{{ URL::action('Front\TorrentController@detail', ['id'=>$data->id]) }}">{{ $data->name }}</a></h4>
											<p>
                                                <span class="text-color-999">文件大小：2.3 GB　</span>
                                                <span class="text-color-999">创建时间：{{ substr($data->create_time,0,10) }}　</span>
                                                <span class="text-color-999">热度：{{ $data->requests }} 次下载</span>
											</p>
											<p>
												<a style="color:green;" href="magnet:?xt=urn:btih:{{ $data->info_hash }}">[磁力链接] </a>
											</p>
										</div>
									</div>
								@endforeach()
								<div class="paginate" style="text-align:center;">{!! $datas->links() !!}</div>
							</div>
						</div>
						<div class="mod-footer"></div>
					</div>
				</div>

				<!-- 侧边栏 -->
				<div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm">
						<!-- 相关话题 -->
						<div class="aw-mod new-topic">
							<div class="mod-head">
								<h3>相关搜索</h3>
							</div>
							<div class="mod-body clearfix">
								<div class="aw-topic-bar">
									<div class="topic-bar clearfix">

									</div>
								</div>
							</div>
						</div>
						<!-- end 相关话题 -->

        				<div class="aw-mod aw-text-align-justify">
                            	<div class="mod-head">
                            		<a href="{{ url('/topic') }}" class="pull-right">更多 &gt;</a>
                            		<h3>热门标签</h3>
                            	</div>
                    			<div class="mod-body">

                    			</div>
        				 </div>
				</div>
				<!-- end 侧边栏 -->
			</div>
		</div>
	</div>
</div>
@endsection
