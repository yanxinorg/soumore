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
                            <div class="mod-body aw-feed-list clearfix" id="main_contents">
                                <div class="aw-mod aw-topic-category">
                                    <div class="mod-body clearfix">
                                        <ul>
                                            <li><a class="active" href="{{ url('/person/postCollect') }}">文章</a></li>
                                            <li><a  href="{{ url('/person/answerCollect') }}">问答</a></li>
                                            <li><a  href="{{ url('/person/videoCollect') }}">视频</a></li>
                                        </ul>
                                    </div>
                                </div>
                                @foreach($datas as $data)
                                <div class="aw-item" data-history-id="8">
                                    <div class="mod-head">
                                        <a data-id="1" class="aw-user-img aw-border-radius-5" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}"><img src="{{  $data->avator }}" ></a>
                                        <p class="text-color-999">
                                            <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" class="aw-user-name" data-id="1">{{ $data->author }}</a> 发表了文章 • {{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}} •
                                            <a href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}" class="text-color-999">{{ $data->countcomment }} 个评论</a>
                                        </p>
                                        <h4><a href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ $data->title  }}</a></h4>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="mod-footer">
                                <div class="paginate" style="text-align:center;">{{ $datas->links() }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- 侧边栏 -->
                    <div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm">

                        <div class="aw-mod side-nav">
                            <div class="mod-body">
                                <ul>
                                    <li><a href="{{ url('/dynamic') }}" ><i class="icon icon-home"></i>最新动态</a></li>
                                    <li><a href="{{ url('/person/post') }}"  ><i class="icon icon-home"></i>我的文章</a></li>
                                    <li><a href="{{ url('/person/answer') }}" ><i class="icon icon-home"></i>我的问答</a></li>
                                    <li><a href="{{ url('/person/video') }}"><i class="icon icon-draft"></i>我的视频</a></li>
                                    <li><a href="{{ url('/person/postCollect') }}" class="active"><i class="icon icon-favor"></i>我的收藏</a></li>
                                    <li><a href="{{ url('/person/topicAttention') }}" rel="focus_topic__focus"><i class="icon icon-mytopic"></i>我的话题</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="aw-mod side-nav">
                            <div class="mod-body">
                                <ul>
                                    <li><a href="{{ url('/topic') }}"><i class="icon icon-topic"></i>所有话题</a></li>
                                    <li><a href="{{ url('/user/hot') }}"><i class="icon icon-user"></i>所有用户</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="aw-mod side-nav"></div>
                    </div>
                    <!-- end 侧边栏 -->
                </div>
            </div>
        </div>
    </div>

@endsection