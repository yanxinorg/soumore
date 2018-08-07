@extends('layouts.ask')
@section('content')
    <div class="aw-container-wrap">
        <div class="container1">
            <div class="row">
                <div class="aw-content-wrap clearfix">
                    <div class="col-sm-12 col-md-9 aw-main-content">
                        <div class="aw-mod clearfix">
                            <div class="mod-head common-head">
                                <h2 >关注的话题</h2>
                            </div>
                            <div class="mod-body aw-feed-list" >
                                <div class="row">
                                    @foreach($topics as $tag )
                                        <div class="col-md-6" style="margin-top: 16px;">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <a class="img aw-border-radius-5" href="{{ URL::action('Front\TopicController@detail', ['id'=>$tag->tag_id]) }}">
                                                        <img style="width:100%;" src="{{ $tag->tag_thumb }}" alt="{{ $tag->tag_name }}">
                                                    </a>
                                                </div>
                                                <div class="col-md-9">
                                                    <p class="clearfix" >
                                                        <a class="text" href="{{ URL::action('Front\TopicController@detail', ['id'=>$tag->tag_id]) }}">{{ $tag->tag_name }}</a>
                                                    </p>
                                                    <p class="text-color-999">
                                                        <span>{{ $tag->tag_watchs }} 个关注</span>
                                                        <span> • </span>
                                                        <span>{{ $tag->tag_posts }} 个文章</span>
                                                        <span> • </span>
                                                        <span>{{ $tag->tag_questions }} 个问答</span>
                                                        <span> • </span>
                                                        <span>{{ $tag->tag_videos }} 个视频</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach()
                                </div>
                            </div>
                            <div class="paginate" style="text-align:center;">{{ $topics->links() }}</div>
                        </div>
                    </div>
                    <!-- 侧边栏 -->
                    <div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm">

                        <div class="aw-mod side-nav">
                            <div class="mod-body">
                                <ul>
                                    <li><a href="{{ url('/person/post') }}"  ><i class="icon icon-home"></i>我的文章</a></li>
                                    <li><a href="{{ url('/person/answer') }}" ><i class="icon icon-home"></i>我的问答</a></li>
                                    <li><a href="{{ url('/person/video') }}"><i class="icon icon-draft"></i>我的视频</a></li>
                                    <li><a href="{{ url('/person/postCollect') }}"><i class="icon icon-favor"></i>我的收藏</a></li>
                                    <li><a href="{{ url('/person/topicAttention') }}" rel="focus_topic__focus" class="active"><i class="icon icon-mytopic"></i>我的话题</a></li>
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