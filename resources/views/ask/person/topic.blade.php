@extends('layouts.ask')
@section('content')
    <div class="aw-container-wrap">
        <div class="container1">
            <div class="row">
                <div class="aw-content-wrap clearfix">
                    <div class="col-sm-12 col-md-9 aw-main-content">
                        <!-- 新消息通知 -->
                        <div class="aw-mod aw-notification-box collapse" id="index_notification">
                            <div class="mod-head common-head">
                                <h2>
                                    <span class="pull-right"><a href="http://ask.com/?/account/setting/privacy/#notifications" class="text-color-999"><i class="icon icon-setting"></i> 通知设置</a></span>
                                    <i class="icon icon-bell"></i>新通知<em class="badge badge-important" name="notification_unread_num">0</em>
                                </h2>
                            </div>
                            <div class="mod-body">
                                <ul id="notification_list"></ul>
                            </div>
                            <div class="mod-footer clearfix">
                                <a href="javascript:;" onclick="AWS.Message.read_notification(false, 0, false);" class="pull-left btn btn-mini btn-default">我知道了</a>
                                <a href="http://ask.com/?/notifications/" class="pull-right btn btn-mini btn-success">查看所有</a>
                            </div>
                        </div>
                        <!-- end 新消息通知 -->

                        <a name="c_contents"></a>
                        <div class="aw-mod clearfix">
                            <div class="mod-head common-head">
                                <h2 id="main_title">关注的话题</h2>
                            </div>

                            <div class="mod-body aw-feed-list clearfix aw-topic-list" id="main_contents">

                                @foreach($topics as $topic)
                                <div class="aw-item">
                                    <!-- 话题图片 -->
                                    <a class="img aw-border-radius-5" href="{{ URL::action('Front\TopicController@detail', ['id'=>$topic->tag_id]) }}" ><img style="width: 50px;" src="{{ $topic->tag_thumb }}" ></a>
                                    <!-- end 话题图片 -->
                                    <p class="clearfix">
                                        <!-- 话题内容 -->
                                        <span class="topic-tag"><a class="text" href="{{ URL::action('Front\TopicController@detail', ['id'=>$topic->tag_id]) }}" >{{ $topic->tag_name }}</a></span>
                                        <!-- end 话题内容 -->
                                    </p>
                                    <p class="text-color-999">
                                        <span>1 个讨论</span>
                                        <span>1 个关注</span>
                                    </p>
                                    <p class="text-color-999">
                                        7 天新增 1 个讨论, 30 天新增 1 个讨论    </p>
                                </div>
                                @endforeach()
                            </div>
                            <div class="paginate" style="text-align:center;">{{ $topics->links() }}</div>
                            <div class="mod-footer">
                            </div>
                        </div>
                    </div>
                    <!-- 侧边栏 -->
                    <div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm">

                        <div class="aw-mod side-nav">
                            <div class="mod-body">
                                <ul>
                                    <li><a href="{{ URL::action('Front\PersonController@post', ['status'=>'1']) }}"  ><i class="icon icon-home"></i>最新文章</a></li>
                                    <li><a href="{{ url('/person/answer') }}" ><i class="icon icon-home"></i>最新问答</a></li>
                                    <li><a href="{{ URL::action('Front\PersonController@post', ['status'=>'0']) }}"><i class="icon icon-draft"></i>我的草稿</a></li>
                                    <li><a href="{{ url('/person/postCollect') }}"><i class="icon icon-favor"></i>我的收藏</a></li>
                                    <li><a href="{{ url('/person/topicAttention') }}" class="active"><i class="icon icon-mytopic"></i>我关注的话题</a></li>
                                    <li><a href="" rel="invite_list__invite"><i class="icon icon-invite"></i>邀请我回复的问题</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="aw-mod side-nav">
                            <div class="mod-body">
                                <ul>
                                    <li><a href="{{ url('/topic') }}"><i class="icon icon-topic"></i>所有话题</a></li>
                                    <li><a href=""><i class="icon icon-user"></i>所有用户</a></li>
                                    <li><a href=""><i class="icon icon-inviteask"></i>邀请好友加入 <em class="badge">10</em></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- 可能感兴趣的人/或话题 -->
                        <div class="aw-mod interest-user">
                            <div class="mod-head"><h3>可能感兴趣的人或话题</h3></div>
                            <div class="mod-body">
                                <dl>
                                    <dt class="pull-left aw-border-radius-5">
                                        <a href="http://ask.com/?/people/admin" data-id="4" class="aw-user-name"><img alt="admin" src="./动态 - WeCenter_files/avatar-min-img.png"></a>
                                    </dt>
                                    <dd class="pull-left">
                                        <a href="http://ask.com/?/people/admin" data-id="4" class="aw-user-name"><span>admin</span></a>
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick=""></a>
                                        <p class="signature"></p>
                                        <p></p>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt class="pull-left aw-border-radius-5">
                                        <a href="http://ask.com/?/people/admin" data-id="2" class="aw-user-name"><img alt="admin" src="./动态 - WeCenter_files/avatar-min-img.png"></a>
                                    </dt>
                                    <dd class="pull-left">
                                        <a href="http://ask.com/?/people/admin" data-id="2" class="aw-user-name"><span>admin</span></a>
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick=""></a>
                                        <p class="signature"></p>
                                        <p></p>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt class="pull-left aw-border-radius-5">
                                        <a href="http://ask.com/?/people/admin" data-id="3" class="aw-user-name"><img alt="admin" src="./动态 - WeCenter_files/avatar-min-img.png"></a>
                                    </dt>
                                    <dd class="pull-left">
                                        <a href="http://ask.com/?/people/admin" data-id="3" class="aw-user-name"><span>admin</span></a>
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick=""></a>
                                        <p class="signature"></p>
                                        <p></p>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt class="pull-left aw-border-radius-5">
                                        <a href=""><img alt="默认话题" src="./动态 - WeCenter_files/topic-mid-img.png"></a>
                                    </dt>
                                    <dd class="pull-left">
                                        <span class="topic-tag">
                                            <a href="" class="text">默认话题</a>
                                        </span>&nbsp;
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick=""></a>
                                        <p></p>
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