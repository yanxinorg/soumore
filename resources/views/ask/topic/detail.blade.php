@extends('layouts.ask')
@section('content')
<div class="aw-container-wrap">
	<div class="container">
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
							<img style="width:50px;" src="{{ $datas->thumb }}" alt="地方">
							<h2 class="pull-left">{{ $datas->name }} </h2>
							<div class="aw-topic-operate text-color-999">
								<a href="javascript:;" onclick="AWS.User.follow($(this), &#39;topic&#39;, 2);" class="follow btn btn-normal btn-success active"><span>取消关注</span> <em>|</em> <b>1</b></a>
							</div>
						</div>
					</div>

					<div class="aw-mod aw-topic-list-mod">
						<div class="mod-head">
							<div class="tabbable">
								<!-- tab 切换 -->
								<ul class="nav nav-tabs aw-nav-tabs hidden-xs">
									<li class="active"><a href="http://ask.com/?/#all" data-toggle="tab">全部内容</a></li>
									<li><a href="http://ask.com/?/#best_answers" data-toggle="tab">精华</a></li>
									<li><a href="http://ask.com/?/#recommend" data-toggle="tab">推荐</a></li>
    								<li><a href="http://ask.com/?/#questions" data-toggle="tab">问题</a></li>
    								<li><a href="http://ask.com/?/#favorite" id="i_favorite" data-toggle="tab" style="display:none">我的收藏</a></li>
									<li><a href="http://ask.com/?/#about" id="i_about" data-toggle="tab">关于话题</a></li>
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

						<div class="mod-body">
							<!-- tab 切换内容 -->
							<div class="tab-content">
								<div class="tab-pane active" id="all">
									<!-- 推荐问题 -->
									<!-- end 推荐问题 -->
									<div class="aw-mod">
										<div class="mod-body">
											<div class="aw-common-list" id="c_all_list">
												<div class="aw-item active" data-topic-id="2,">
                                                	<a class="aw-user-name hidden-xs" data-id="1" href="http://ask.com/?/people/admin" rel="nofollow"><img src="./地方 - WeCenter_files/avatar-max-img.png" alt=""></a>	
                                                	<div class="aw-question-content">
                                                		<h4><a href="http://ask.com/?/question/1">c测送对方对方的</a></h4>
                                                				<a href="http://ask.com/?/question/1#!answer_form" class="pull-right text-color-999">回复</a>
                                    							<p>
                                        							<a class="aw-question-tags" href="http://ask.com/?/explore/category-1">默认分类</a>
                                        				• 			<a href="http://ask.com/?/people/admin" class="aw-user-name">admin</a>
                                        							<span class="text-color-999">发起了问题 • 1 人关注 • 0 个回复 • 3 次浏览 • 14 小时前</span>
                                        							<span class="text-color-999 related-topic collapse"> • 来自相关话题</span>
                                    							</p>

													</div>
												</div>
											</div>
										</div>
										<div class="mod-footer">
											<a class="aw-load-more-content" id="c_all_more" auto-load="false" data-page="2">
												<span>更多...</span>
											</a>
										</div>
									</div>
								</div>

								<div class="tab-pane" id="best_answers">
									<div class="aw-feed-list" id="c_best_question_list">
										<div class="mod-body"></div>
										<div class="mod-footer">
											<a class="aw-load-more-content" id="bp_best_question_more" auto-load="false" data-page="2">
												<span>更多...</span>
											</a>
										</div>
									</div>
								</div>

								<div class="tab-pane" id="recommend">
									<div class="aw-mod">
										<div class="mod-body">
											<div class="aw-common-list" id="c_recommend_list"></div>
										</div>
										<div class="mod-footer">
											<a class="aw-load-more-content" id="c_recommend_more" auto-load="false" data-page="2">
												<span>更多...</span>
											</a>
										</div>
									</div>
								</div>

								<div class="tab-pane" id="questions">
									<div class="aw-mod">
										<div class="mod-body">
											<div class="aw-common-list" id="c_question_list">
												<div class="aw-item active" data-topic-id="2,">
                                                	<a class="aw-user-name hidden-xs" data-id="1" href="http://ask.com/?/people/admin" rel="nofollow"><img src="./地方 - WeCenter_files/avatar-max-img.png" alt=""></a>	
                                                	<div class="aw-question-content">
                                                		<h4><a href="http://ask.com/?/question/1">c测送对方对方的</a></h4>
                                                		<a href="http://ask.com/?/question/1#!answer_form" class="pull-right text-color-999">回复</a>
                            							<p>
                                							<a class="aw-question-tags" href="http://ask.com/?/explore/category-1">默认分类</a>
                                				• 			<a href="http://ask.com/?/people/admin" class="aw-user-name">admin</a>				
                                							<span class="text-color-999">发起了问题 • 1 人关注 • 0 个回复 • 3 次浏览 • 14 小时前</span>
                                							<span class="text-color-999 related-topic collapse"> • 来自相关话题</span>
                            							</p>

													</div>
												</div>
											</div>
										</div>
										<div class="mod-footer">
											<a class="aw-load-more-content" id="c_question_more" auto-load="false" data-page="2">
												<span>更多...</span>
											</a>
										</div>
									</div>
								</div>

								<div class="tab-pane" id="articles">
									<!-- 动态首页&话题精华模块 -->
									<div class="aw-mod">
										<div class="mod-body">
											<div class="aw-common-list" id="c_articles_list">
																							</div>
										</div>
										<div class="mod-footer">
											<a class="aw-load-more-content" id="bp_articles_more" auto-load="false" data-page="2">
												<span>更多...</span>
											</a>
										</div>
									</div>
									<!-- end 动态首页&话题精华模块 -->
								</div>

								<div class="tab-pane" id="favorite">
									<!-- 动态首页&话题精华模块 -->
									<div class="aw-mod aw-feed-list" id="c_favorite_list"><p style="padding: 15px 0" align="center">没有内容</p></div>
									<!-- end 动态首页&话题精华模块 -->

									<!-- 加载更多内容 -->
									<a class="aw-load-more-content disabled" id="bp_favorite_more" data-page="0">
										<span>没有更多了</span>
									</a>
									<!-- end 加载更多内容 -->
								</div>

								<div class="tab-pane" id="about">
									<div class="aw-topic-detail-about text-color-666 markitup-box">
										{{ $datas->desc }}
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

					<div class="aw-mod topic-about">
                    	<div class="mod-head">
                    		<h3>相关话题</h3>
                    	</div>
                    	<div class="mod-body" data-type="topic">
                    		<div class="aw-topic-bar" data-type="topic" data-id="2">
                    			<div class="tag-bar clearfix">
                    			@foreach($relateAttens as $relate)
                    				<a href="{{ URL::action('Front\TopicController@detail', ['id'=>$relate->id]) }}"><img style="width: 36px;" alt="{{ $relate->name }}" src="{{ $relate->thumb }}"></a>
                    			@endforeach()
                    			</div>
                    		</div>
                    	</div>
					</div>
					
					<!-- 最佳回复者 -->
					<!-- end 最佳回复者 -->

					<!-- xx人关注该话题 -->
					<div class="aw-mod topic-status">
						<div class="mod-head">
							<h3>{{ $attenCount }}人关注该话题</h3>
						</div>
						<div class="mod-body">
							<div id="focus_users" class="aw-border-radius-5">
								@foreach($attenUsers as $user)
								<a href="{{ URL::action('Front\HomeController@index', ['uid'=>$user->user_id]) }}"><img src="{{ route('getThumbImg', $user->user_id) }}" alt="admin"></a> 
								@endforeach()
							</div>
						</div>
					</div>
					<!-- end xx人关注该话题 -->

					<!-- 话题修改记录 -->
					<div class="aw-mod topic-edit-notes">
						<div class="mod-head">
							<h3><i class="icon icon-down pull-right"></i>话题修改记录</h3>
						</div>
						<div class="mod-body collapse">
							<ul>
								<li onclick="AWS.dialog(&#39;topicEditHistory&#39;, decodeURIComponent(&#39;2018-04-05%3A%20%3Ca%20href%3D%22people%2Fadmin%22%3Eadmin%3C%2Fa%3E%20%E4%BF%AE%E6%94%B9%E4%BA%86%E8%AF%9D%E9%A2%98%E5%9B%BE%E7%89%87&#39;));">
									<span class="pull-right text-color-999">2018-04-05</span>
									<a href="javascript:;" data-id="" class="aw-user-name">admin</a>
								</li>
								<li onclick="AWS.dialog(&#39;topicEditHistory&#39;, decodeURIComponent(&#39;2018-04-05%3A%20%3Ca%20href%3D%22people%2Fadmin%22%3Eadmin%3C%2Fa%3E%20%E5%88%9B%E5%BB%BA%E4%BA%86%E8%AF%A5%E8%AF%9D%E9%A2%98%3C%2Fp%3E&#39;));">
									<span class="pull-right text-color-999">2018-04-05</span>
									<a href="javascript:;" data-id="" class="aw-user-name">admin</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- end 话题修改记录 -->

					<div class="aw-mod">
						<div class="mod-head">
							<h3>管理</h3>
						</div>
						<div class="mod-body">
							<ul>
								<li><a href="http://ask.com/?/topic/edit/2">编辑话题</a></li>
								<li><a href="http://ask.com/?/topic/manage/2">管理话题</a></li>
								<li><a href="javascript:;" onclick="AWS.ajax_request(G_BASE_URL + &#39;/topic/ajax/lock/&#39;, &#39;topic_id=2&#39;);">锁定话题</a></li>
								<li><a href="javascript:;" onclick="AWS.dialog(&#39;confirm&#39;, {&#39;message&#39; : &#39;确认删除?&#39;}, function(){AWS.ajax_request(G_BASE_URL + &#39;/topic/ajax/remove/&#39;, &#39;topic_id=2&#39;);});">删除话题</a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end 侧边栏 -->
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var TOPIC_ID = '2';
	var CONTENTS_TOPIC_ID = '2';
	var CONTENTS_RELATED_TOPIC_IDS = '2';
	var CONTENTS_TOPIC_TITLE = '地方';
</script>
<script type="text/javascript" src="./地方 - WeCenter_files/topic.js"></script>
@endsection