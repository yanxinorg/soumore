@extends('layouts.ask')
@section('content')
    <div class="aw-container-wrap">
        <div class="container">
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
                                <a href="javascript:;" onclick="" class="pull-left btn btn-mini btn-default">我知道了</a>
                                <a href="http://ask.com/?/notifications/" class="pull-right btn btn-mini btn-success">查看所有</a>
                            </div>
                        </div>
                        <!-- end 新消息通知 -->

                        <a name="c_contents"></a>
                        <div class="aw-mod clearfix">
                            <div class="mod-body aw-feed-list clearfix" id="main_contents">

                                <div class="aw-mod aw-topic-category">
                                    <div class="mod-body clearfix">
                                        <ul>
                                            <li><a  href="{{ url('/person/postCollect') }}">文章</a></li>
                                            <li><a class="active" href="{{ url('/person/answerCollect') }}">问答</a></li>
                                        </ul>
                                    </div>
                                </div>

                                @foreach($questions as $data)
                                <div class="aw-item" data-history-id="8">
                                    <div class="mod-head">
                                        <a data-id="1" class="aw-user-img aw-border-radius-5" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}"><img src="{{ $data->avator }}" ></a>
                                        <p class="text-color-999">
                                            <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" class="aw-user-name" data-id="1">{{ $data->user_name }}</a> 发表了文章 • {{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}} •
                                            <a href="{{ URL::action('Front\QuestionController@detail', ['id'=>$data->question_id]) }}" class="text-color-999">{{ $data->comments }} 个评论</a>
                                        </p>
                                        <h4><a href="{{ URL::action('Front\QuestionController@detail', ['id'=>$data->question_id]) }}">{{ $data->title  }}</a></h4>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="mod-footer">
                                <div class="paginate" style="text-align:center;">{{ $questions->links() }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- 侧边栏 -->
                    <div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm">

                        <div class="aw-mod side-nav">
                            <div class="mod-body">
                                <ul>
                                    <li><a href="{{ URL::action('Front\PersonController@post', ['status'=>'1']) }}" ><i class="icon icon-home"></i>最新文章</a></li>
                                    <li><a href="{{ url('/person/answer') }}" ><i class="icon icon-home"></i>最新问答</a></li>
                                    <li><a href="{{ URL::action('Front\PersonController@post', ['status'=>'0']) }}"><i class="icon icon-draft"></i>我的草稿</a></li>
                                    <li><a href="{{ url('/person/postCollect') }}" class="active"><i class="icon icon-favor"></i>我的收藏</a></li>
                                    <li><a href="{{ url('/person/topicAttention') }}" rel="focus_topic__focus"><i class="icon icon-mytopic"></i>我关注的话题</a></li>
                                    <li><a href=""><i class="icon icon-invite"></i>邀请我回复的问题</a></li>
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
                                        <a href="" data-id="4" class="aw-user-name"><span>admin</span></a>
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick="AWS.User.follow($(this), &#39;user&#39;, 4);AWS.ajax_request(G_BASE_URL + &#39;/account/ajax/clean_user_recommend_cache/&#39;);"></a>
                                        <p class="signature"></p>
                                        <p></p>
                                    </dd>
                                </dl>

                                <dl>
                                    <dt class="pull-left aw-border-radius-5">
                                        <a href="" data-id="3" class="aw-user-name"><img alt="admin" src="./动态 - WeCenter_files/avatar-min-img.png"></a>
                                    </dt>
                                    <dd class="pull-left">
                                        <a href="" data-id="3" class="aw-user-name"><span>admin</span></a>
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick="AWS.User.follow($(this), &#39;user&#39;, 3);AWS.ajax_request(G_BASE_URL + &#39;/account/ajax/clean_user_recommend_cache/&#39;);"></a>
                                        <p class="signature"></p>
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