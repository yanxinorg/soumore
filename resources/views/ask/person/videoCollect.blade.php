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
                                <a href="javascript:;" onclick="" class="pull-left btn btn-mini btn-default">我知道了</a>
                                <a href="http://ask.com/?/notifications/" class="pull-right btn btn-mini btn-success">查看所有</a>
                            </div>
                        </div>
                        <!-- end 新消息通知 -->
                        <div class="aw-mod clearfix">
                            <div class="mod-body aw-feed-list clearfix" >
                                <div class="aw-mod aw-topic-category">
                                    <div class="mod-body clearfix">
                                        <ul>
                                            <li><a  href="{{ url('/person/postCollect') }}">文章</a></li>
                                            <li><a href="{{ url('/person/answerCollect') }}">问答</a></li>
                                            <li><a class="active" href="{{ url('/person/videoCollect') }}">视频</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mod-body clearfix">
                                    @foreach($videos as $video)
                                        <div class="aw-item col-md-3" >
                                            <a class="img aw-border-radius-5" href="{{ URL::action('Front\VideoController@detail', ['id'=>$video->id]) }}">
                                                <img style="width:180px;height: 120px;" src="{{ $video->thumb }}" alt="{{ $video->title }}">
                                            </a>
                                            <p class="clearfix" style="margin-top: 12px;">
                                                <a class="text" href="{{ URL::action('Front\VideoController@detail', ['id'=>$video->id]) }}">{{ str_limit($video->title,36) }}</a>
                                            </p>
                                            <p class="text-color-999">
                                                <span>作者：<a class="aw-user-name hidden-xs" href="{{ URL::action('Front\HomeController@index', ['uid'=>$video->user_id]) }}" rel="nofollow">{{ $video->author }}</a></span>
                                            </p>
                                            <p class="text-color-999">
                                                <span>发布时间：{{ substr($video->created_at,0,11) }}</span>
                                            </p>
                                        </div>
                                    @endforeach()
                                </div>
                            </div>
                            <div class="mod-footer clearfix">
                                <div class="paginate" style="text-align:center;">{{ $videos->links() }}</div>
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