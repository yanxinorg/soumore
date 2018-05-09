@extends('layouts.ask')
@section('content')
<link  rel="stylesheet" type="text/css" href="{{ asset('ask/user_files/user.css') }}">
    <div class="aw-container-wrap">
        <div class="container1">
            <div class="row">
                <div class="aw-content-wrap clearfix">
                    <div class="col-sm-12 col-md-9 aw-main-content">
                        <!-- 用户数据内容 -->
                        <div class="aw-mod aw-user-detail-box">
                            <div class="mod-head">
                                <img style="width:100px;" src="{{ $userinfo['avator'] }}-sm_thumb_middle" >
                                @if(Auth::id() == $uid)
                                <span class="pull-right operate">
                                    <a href="{{ url('/person/info') }}" class="btn btn-mini btn-success">编辑</a>
                                </span>
                                @elseif( $islooked )
                                    <span class="pull-right operate">
                                        <a class="text-color-999" onclick=""><i class="icon icon-inbox"></i> 私信</a><a onclick="" class="text-color-999 hidden-xs"><i class="icon icon-at"></i> 问Ta</a><a href="{{ URL::action('Front\AttentionController@cancelUser', ['uid'=>$uid]) }}" class="follow btn btn-normal btn-success active" ><span>取消关注</span></a>
                                    </span>
                                 @else
                                     <span class="pull-right operate">
                                         <a href="{{ URL::action('Front\AttentionController@user', ['uid'=>$uid]) }}" class="follow btn btn-normal btn-success" ><span>关注</span> </a>
                                     </span>
                                @endif
                                <h1>{{ $userinfo->name }}</h1>
                                    <p class="text-color-999">{{ $userinfo->bio }}</p>
                                    <p class="aw-user-flag">
                                     @if(!empty($province))<span><i class="icon icon-location"></i> {{ $province }} {{ $city }}市</span>@endif
                                     @if(!empty($userinfo->occupation))  <span><i class="icon icon-job"></i> {{ $userinfo->occupation }}</span>@endif
                                    </p>
                            </div>
                            <div class="mod-body">
                                <div class="meta">
                                    <span><i class="icon icon-prestige"></i> 威望 : <em class="aw-text-color-green">0</em></span>
                                    <span><i class="icon icon-agree"></i> 赞同 : <em class="aw-text-color-orange">0</em></span>
                                    <span><i class="icon icon-thank"></i> 感谢 : <em class="aw-text-color-orange">0</em></span>
                                </div>
                            </div>
                            <div class="mod-footer">
                                <ul class="nav nav-tabs aw-nav-tabs">
                                    <li><a href="" id="page_overview" data-toggle="tab">概述</a></li>
                                    <li><a href="{{ URL::action('Front\HomeController@question', ['uid'=>$uid]) }}">问答<span class="badge">{{ $countQuestion }}</span></a></li>
                                    <li><a href="" id="page_answers" data-toggle="tab">回复<span class="badge">0</span></a></li>
                                    <li class="active"><a href="{{ URL::action('Front\HomeController@post', ['uid'=>$uid]) }}">文章<span class="badge">{{ $countPost }}</span></a></li>
                                    <li><a href="{{ URL::action('Front\HomeController@topicUser', ['uid'=>$uid]) }}">关注</a></li>
                                    <li><a href="" id="page_actions" data-toggle="tab">动态</a></li>
                                    <li><a href="" id="page_detail" data-toggle="tab">详细资料</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- end 用户数据内容 -->

                        <div class="aw-user-center-tab">
                            <div class="tab-content">
                                <div class="tab-pane " id="overview">
                                    <!-- 回复 -->
                                    <div class="aw-mod">
                                        <div class="mod-head">
                                            <h3><a class="pull-right aw-more-content" href="javascript:;" onclick="$(&#39;#page_answers&#39;).click();">更多 »</a>回复</h3>
                                        </div>
                                        <div class="mod-body">
                                            <div class="aw-profile-answer-list">
                                                <p class="padding10 text-center">没有内容</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end 回复 -->

                                    <!-- 发问 -->
                                    <div class="aw-mod">
                                        <div class="mod-head">
                                            <h3><a class="pull-right aw-more-content" href="javascript:;" onclick="$(&#39;#page_questions&#39;).click();">更多 »</a>发问</h3>
                                        </div>
                                        <div class="mod-body">
                                            <div class="aw-profile-publish-list">
                                                <p class="padding10 text-center">没有内容</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end 发问 -->

                                    <!-- 最新动态 -->
                                    <div class="aw-mod">
                                        <div class="mod-head">
                                            <h3><a class="pull-right aw-more-content" href="javascript:;" onclick="$(&#39;#page_actions&#39;).click();">更多 »</a>动态</h3>
                                        </div>
                                        <div class="mod-body">
                                            <ul>
                                                <p class="padding10 text-center">没有内容</p>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="answers">
                                    <div class="aw-mod">
                                        <div class="mod-head">
                                            <h3>回复</h3>
                                        </div>
                                        <div class="mod-body">
                                            <div class="aw-profile-answer-list" id="contents_user_actions_answers"><p style="padding: 15px 0" align="center">没有内容</p></div>
                                        </div>
                                        <div class="mod-footer">
                                            <!-- 加载更多内容 -->
                                            <a class="aw-load-more-content disabled" id="bp_user_actions_answers_more" data-page="0">
                                                <span>没有更多了</span>
                                            </a>
                                            <!-- end 加载更多内容 -->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane active" id="articles">
                                    <div class="aw-mod">
                                        <div class="mod-head">
                                            <h3>文章</h3>
                                        </div>
                                        <div class="mod-body">
                                                <div class="aw-profile-publish-list" id="contents_user_actions_articles">
                                                    @foreach($datas as $data)
                                                        <div class="aw-item">
                                                            <div class="aw-mod">
                                                                <div class="mod-head">
                                                                    <h4 class="aw-hide-txt">
                                                                        <a href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ $data->title  }}</a>
                                                                    </h4>
                                                                </div>
                                                                <div class="mod-body">
                                                                    <span class="aw-border-radius-5 count pull-left"><i class="icon icon-agree"></i>0</span>
                                                                    <p class="text-color-999">1 次浏览 • 1 个关注 • {{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach()
                                                     <div class="paginate" style="text-align:center;">{!! $datas->appends(array('uid'=>$uid ))->render() !!}</div>
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="detail">
                                    <div class="aw-mod">
                                        <div class="mod-head">
                                            <h3>详细资料</h3>
                                        </div>
                                        <div class="mod-body aw-user-center-details">
                                            <dl>
                                                <dt><span>个人成就:</span></dt>
                                                <dd>
                                                    <p class="meta">
                                                        <span><i class="icon icon-prestige"></i>威望: <em class="aw-text-color-green">0</em></span>
                                                        <span><i class="icon icon-agree"></i>赞同: <em class="aw-text-color-orange">0</em></span>
                                                        <span><i class="icon icon-thank"></i>感谢: <em class="aw-text-color-orange">0</em></span>
                                                    </p>
                                                </dd>
                                            </dl>
                                            <dl>
                                                <dt><span>最后活跃:</span></dt>
                                                <dd>41 秒前</dd>
                                            </dl>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 侧边栏 -->
                    <div class="col-sm-12 col-md-3 aw-side-bar">
                        <div class="aw-mod people-following">
                            <div class="mod-body">
                                <a href="{{ URL::action('Front\HomeController@topicUser', ['uid'=>$uid]) }}" class="pull-right font-size-12">更多 »</a>
                                <span>关注 <em class="aw-text-color-blue">{{  $countUsers }}</em>人</span>
                                <p>
                                @foreach($topicUsers as $topicUser)
                                    <a class="aw-user-name" data-id="3" href="{{ URL::action('Front\HomeController@index', ['uid'=>$topicUser->user_id]) }}"><img src="{{ $topicUser->avator }}-sm_thumb_small" /></a>
                                @endforeach()
                                </p>
                            </div>
                        </div>
                        <div class="aw-mod people-following">
                            <div class="mod-body">
                                <a href="{{ URL::action('Front\HomeController@topicedUser', ['uid'=>$uid]) }}" class="pull-right font-size-12">更多 »</a>
                                <span> 被 <em class="aw-text-color-blue">{{ $countFans  }}</em> 人关注</span>
                                <p>
                                	@foreach($fans as $fan)
                                    <a class="aw-user-name" data-id="3" href="{{ URL::action('Front\HomeController@index', ['uid'=>$fan->user_id]) }}"><img src="{{ $fan->avator }}-sm_thumb_middle" /></a>
                                	@endforeach()
                                </p>
                            </div>
                        </div>
                        <div class="aw-mod people-following">
                            <div class="mod-body">关注 <em class="aw-text-color-blue">{{ $countTopics }}</em> 话题 </div>
                            <div class="aw-topic-bar">
                                <div class="tag-bar clearfix">
                                	@foreach($topics as $topic)
                                      <span class="topic-tag"><a href="{{ URL::action('Front\TopicController@detail', ['id'=>$topic->tag_id]) }}" class="text" data-id="3">{{ $topic->tag_name }}</a></span>
                                 	@endforeach()
                                 </div>
                            </div>
                        </div>
                        <div class="aw-mod">
                            <div class="mod-body">
                            <span class="aw-text-color-666">最近访客</span>
                            	<p>
                            	@foreach($recents as $recent)
                                    <a class="aw-user-name" data-id="3" href="{{ URL::action('Front\HomeController@index', ['uid'=>$recent->user_id]) }}"><img  src="{{ $recent->avator }}-sm_thumb_middle"></a>
                                @endforeach()
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end 侧边栏 -->
                </div>
            </div>
        </div>
    </div>
@endsection