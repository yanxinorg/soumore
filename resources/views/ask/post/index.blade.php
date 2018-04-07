@extends('layouts.ask')
@section('content')
<div class="aw-container-wrap">
<!-- 分类 -->
	<div class="container category">
    	<div class="row">
        	<div class="col-sm-12">
        		@foreach($cates as $cate)
					@if($cate->id == $cid)
						<dl class="active">
                			<dt><img src="{{ $cate->thumb }}" alt="默认分类"></dt>
                			<dd>
                				<p class="title"><a href="{{ URL::action('Front\PostController@cate', ['cid'=>$cate->id]) }}">{{ $cate->name }}</a></p>
                				<span>{{ $cate->desc }}</span>
                			</dd>
            			</dl>
					@else
						<dl >
                			<dt><img src="{{ $cate->thumb }}" alt="默认分类"></dt>
                			<dd>
                				<p class="title"><a href="{{ URL::action('Front\PostController@cate', ['cid'=>$cate->id]) }}">{{ $cate->name }}</a></p>
                				<span>{{ $cate->desc }}</span>
                			</dd>
            			</dl>
					@endif
        		@endforeach()
        	</div>
    	</div>
    	
	</div>
	
	<div class="container">
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
							<a href="javascript:;" onclick="AWS.Message.read_notification(false, 0, false);" class="pull-left btn btn-mini btn-gray">我知道了</a>
							<a href="" class="pull-right btn btn-mini btn-success">查看所有</a>
						</div>
					</div>
					<!-- end 新消息通知 -->
					<!-- tab切换 -->
					<ul class="nav nav-tabs aw-nav-tabs active hidden-xs">
						<li><a href="{{ url('/post') }}">热门</a></li>
						<li><a href="{{ url('/post') }}">推荐</a></li>
						<li class="active"><a href="{{ url('/post') }}">最新</a></li>
						<h2 class="hidden-xs"><i class="icon icon-list"></i>发现</h2>
					</ul>
					<!-- end tab切换 -->
					
					<div class="aw-mod aw-explore-list">
						<div class="mod-body">
							<div class="aw-common-list">
								@foreach($datas as $data)
								<div class="aw-item article" data-topic-id="3,">
										<a class="aw-user-name hidden-xs" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" rel="nofollow"><img src="{{ route('getThumbImg', $data->user_id) }}" alt=""></a>	
										<div class="aw-question-content">
    										<h4><a href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ $data->title }}</a></h4>
                                    		<p>
                                    			<a class="aw-question-tags" href="">默认分类</a>
                                    			<a href="" class="aw-user-name">admin</a> <span class="text-color-999">发表了文章 • {{ $data->countcomment }} 个评论 • {{ $data->hits }} 次浏览 • {{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
                                    			<span class="text-color-999 related-topic collapse"> • 来自相关话题</span>
                                    		</p>
                            				<!-- 文章内容调用 -->
                            				<div class="markitup-box">
                            					<div class="img pull-right"></div>
                            					{!! $data->content !!}
                            				</div>
    										<div class="collapse all-content">{!! $data->content !!}</div>
    		                              <!-- end 文章内容调用 -->
										</div>
								</div>
								@endforeach()
                            	<div class="paginate" style="text-align:center;">{!! $datas->appends(array('cid'=>$cid,'tid'=>$tid))->render() !!}</div>
							</div>
						</div>
						<div class="mod-footer"></div>
					</div>
				</div>

				<!-- 侧边栏 -->
				<div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm">
        				<div class="aw-mod aw-text-align-justify">
                            	<div class="mod-head">
                            		<a href="{{ url('/topic') }}" class="pull-right">更多 &gt;</a>
                            		<h3>热门话题</h3>
                            	</div>
                    	
                    			<div class="mod-body">
                    				@foreach($tags as $tag)
                    				<dl>
                        				<dt class="pull-left aw-border-radius-5">
                        					<a href="{{ URL::action('Front\TopicController@detail', ['id'=>$tag->id]) }}"><img alt="" src="{{ $tag->thumb }}"></a>
                        				</dt>
                        				<dd class="pull-left">
                        					<p class="clearfix">
                        						<span class="topic-tag">
                        							<a href="{{ URL::action('Front\TopicController@detail', ['id'=>$tag->id]) }}" class="text" data-id="2">{{ $tag->name }}</a>
                        						</span>
                        					</p>
                        					<p><b>1</b> 个问题, <b>1</b> 人关注</p>
                        				</dd>
                        			</dl>
                        			@endforeach()
                    				
                    			</div>
        				 </div>
    					<div class="aw-mod aw-text-align-justify">
                            	<div class="mod-head">
                            		<a href="" class="pull-right">更多 &gt;</a>
                            		<h3>热门用户</h3>
                            	</div>
                            	<div class="mod-body">
                            		<dl>
                            			<dt class="pull-left aw-border-radius-5">
                            				<a href=""><img alt="" src="{{ asset('ask/index_files/avatar-mid-img.png') }}"></a>
                            			</dt>
                            			<dd class="pull-left">
                            				<a href="" data-id="4" class="aw-user-name">admin</a>
                            				<p class="signature"></p>
                            				<p><b>0</b> 个问题, <b>0</b> 次赞同</p>
                            			</dd>
                            		</dl>
                            			
                            		<dl>
                            			<dt class="pull-left aw-border-radius-5">
                            				<a href=""><img alt="" src="{{ asset('ask/index_files/avatar-mid-img.png') }}"></a>
                            			</dt>
                            			<dd class="pull-left">
                            				<a href="" data-id="2" class="aw-user-name">admin</a>
                            				<p class="signature"></p>
                            				<p><b>0</b> 个问题, <b>0</b> 次赞同</p>
                            			</dd>
                            		</dl>
                            			
                            		<dl>
                            			<dt class="pull-left aw-border-radius-5">
                            				<a href=""><img alt="" src="{{ asset('ask/index_files/avatar-mid-img.png') }}"></a>
                            			</dt>
                            			<dd class="pull-left">
                            				<a href="" data-id="3" class="aw-user-name">admin</a>
                            				<p class="signature"></p>
                            				<p><b>0</b> 个问题, <b>0</b> 次赞同</p>
                            			</dd>
                            		</dl>
                            	</div>
    					</div>				
				</div>
				<!-- end 侧边栏 -->
			</div>
		</div>
	</div>
</div>
@endsection
