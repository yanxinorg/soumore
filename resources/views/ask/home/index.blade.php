@extends('layouts.ask')
@section('content')
<link  rel="stylesheet" type="text/css" href="{{ asset('ask/user_files/user.css') }}">

    <div class="aw-container-wrap">
        <div class="container">
            <div class="row">
                <div class="aw-content-wrap clearfix">
                    <div class="col-sm-12 col-md-9 aw-main-content">
                        <!-- 用户数据内容 -->
                        <div class="aw-mod aw-user-detail-box">
                            <div class="mod-head">
                                <img  src="{{ route('getThumbImg', Auth::user()->id) }}" alt="{{ Auth::user()->name }}">
                                <span class="pull-right operate">
                                    <a href="http://ask.com/?/account/setting/profile/" class="btn btn-mini btn-success">编辑</a>
                                </span>
                                <h1>admin </h1>
                                <p class="text-color-999"></p>
                                <p class="aw-user-flag">
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
                                    <li class=""><a href="http://ask.com/?/#overview" id="page_overview" data-toggle="tab">概述</a></li>
                                    <li class=""><a href="http://ask.com/?/#questions" id="page_questions" data-toggle="tab">发问<span class="badge">0</span></a></li>
                                    <li class=""><a href="http://ask.com/?/#answers" id="page_answers" data-toggle="tab">回复<span class="badge">0</span></a></li>
                                    <li class="active"><a href="http://ask.com/?/#articles" id="page_articles" data-toggle="tab">文章<span class="badge">{{ $countPost }}</span></a></li>
                                    <li class=""><a href="http://ask.com/?/#focus" id="page_focus" data-toggle="tab">关注</a></li>
                                    <li class=""><a href="http://ask.com/?/#actions" id="page_actions" data-toggle="tab">动态</a></li>
                                    <li class=""><a href="http://ask.com/?/#detail" id="page_detail" data-toggle="tab">详细资料</a></li>
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
                                <div class="tab-pane" id="questions">
                                    <div class="aw-mod">
                                        <div class="mod-head">
                                            <h3>发问</h3>
                                        </div>
                                        <div class="mod-body">
                                            <div class="aw-profile-publish-list" id="contents_user_actions_questions"><p style="padding: 15px 0" align="center">没有内容</p></div>
                                        </div>
                                        <div class="mod-footer">
                                            <!-- 加载更多内容 -->
                                            <a class="aw-load-more-content disabled" id="bp_user_actions_questions_more" data-page="0">
                                                <span>没有更多了</span>
                                            </a>
                                            <!-- end 加载更多内容 -->
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
                                                    {!! $datas->appends(array('uid'=>$userinfo->id ))->render() !!}
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="focus">
                                    <!-- 自定义切换 -->
                                    <div class="aw-mod">
                                        <div class="aw-tabs text-center">
                                            <ul>
                                                <li class="active"><a>关注的人</a></li>
                                                <li><a>关注者</a></li>
                                                <li><a>关注的话题</a></li>
                                            </ul>
                                        </div>
                                        <div class="mod-body">
                                            <div class="aw-tab-content">
                                                <div class="aw-mod aw-user-center-follow-mod">
                                                    <div class="mod-body">
                                                        <ul id="contents_user_follows" class="clearfix"><p style="padding: 15px 0" align="center">没有内容</p></ul>
                                                    </div>
                                                    <div class="mod-footer">
                                                        <!-- 加载更多内容 -->
                                                        <a class="aw-load-more-content disabled" id="bp_user_follows_more" data-page="0">
                                                            <span>没有更多了</span>
                                                        </a>
                                                        <!-- end 加载更多内容 -->
                                                    </div>
                                                </div>
                                                <div class="aw-mod aw-user-center-follow-mod collapse">
                                                    <div class="mod-body">
                                                        <ul class="clearfix" id="contents_user_fans"><li>
                                                                <div class="mod-head">
                                                                    <a class="aw-user-img pull-left aw-border-radius-5" data-id="3" href="http://ask.com/?/people/test">
                                                                        <img src="./admin 的个人主页 - WeCenter_files/avatar-mid-img.png" alt="test">
                                                                    </a>
                                                                    <p><a href="http://ask.com/?/people/test">test</a></p>
                                                                </div>
                                                                <div class="mod-body">
                                                                    <p class="text-color-999 aw-hide-txt"></p>
                                                                </div>
                                                                <div class="mod-footer meta">
                                                                    <span><i class="icon icon-prestige"></i>威望 <em class="aw-text-color-green">0</em></span>
                                                                    <span><i class="icon icon-agree"></i>赞同 <em class="aw-text-color-orange">0</em></span>
                                                                    <!-- <span><i class="icon icon-thank"></i>感谢 <em class="aw-text-color-orange">0</em></span> -->
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="mod-footer">
                                                        <!-- 加载更多内容 -->
                                                        <a class="aw-load-more-content" id="bp_user_fans_more" data-page="1">
                                                            <span>更多</span>
                                                        </a>
                                                        <!-- end 加载更多内容 -->
                                                    </div>
                                                </div>
                                                <div class="aw-mod aw-user-center-follow-mod collapse">
                                                    <div class="mod-body">
                                                        <ul id="contents_user_topics" class="clearfix"><p style="padding: 15px 0" align="center">没有内容</p></ul>
                                                    </div>
                                                    <div class="mod-footer">
                                                        <!-- 加载更多内容 -->
                                                        <a class="aw-load-more-content disabled" id="bp_user_topics_more" data-page="0">
                                                            <span>没有更多了</span>
                                                        </a>
                                                        <!-- end 加载更多内容 -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end 自定义切换 -->
                                </div>
                                <div class="tab-pane" id="actions">
                                    <div class="aw-mod">
                                        <div class="mod-head">
                                            <h3>最新动态</h3>
                                        </div>
                                        <div class="mod-body">
                                            <div id="contents_user_actions"><p style="padding: 15px 0" align="center">没有内容</p></div>
                                        </div>
                                        <div class="mod-footer">
                                            <!-- 加载更多内容 -->
                                            <a class="aw-load-more-content disabled" id="bp_user_actions_more" data-page="0">
                                                <span>没有更多了</span>
                                            </a>
                                            <!-- end 加载更多内容 -->
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
                                <a onclick="$(&#39;#page_focus&#39;).click();$(&#39;#focus .aw-tabs ul li&#39;).eq(0).click();$.scrollTo($(&#39;#focus&#39;).offset()[&#39;top&#39;], 600, {queue:true})" class="pull-right font-size-12">更多 »</a>
                                <span>关注 <em class="aw-text-color-blue">0</em>人</span>
                            </div>
                        </div>
                        <div class="aw-mod people-following">
                            <div class="mod-body">
                                <a onclick="$(&#39;#page_focus&#39;).click();$(&#39;#focus .aw-tabs ul li&#39;).eq(1).click();$.scrollTo($(&#39;#focus&#39;).offset()[&#39;top&#39;], 600, {queue:true})" class="pull-right font-size-12">更多 »</a>
                                <span>
                                被 <em class="aw-text-color-blue">1</em> 人关注</span>
                                <p>
                                    <a class="aw-user-name" data-id="3" href="http://ask.com/?/people/test"><img src="./admin 的个人主页 - WeCenter_files/avatar-mid-img.png" alt="test"></a>
                                </p>
                            </div>

                        </div>
                        <div class="aw-mod people-following">
                            <div class="mod-body">
                                关注 <em class="aw-text-color-blue">0</em> 话题 </div>
                        </div>
                        <div class="aw-mod">
                            <div class="mod-body">
                            <span class="aw-text-color-666">主页访问量 : 3 次访问</span>
                            </div>
                        </div>
                    </div>
                    <!-- end 侧边栏 -->
                </div>
            </div>
        </div>
    </div>
@endsection