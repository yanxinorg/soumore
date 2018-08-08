@extends('layouts.ask')
@section('content')
    <div class="aw-container-wrap">
        <div class="container1">
            <div class="row">
                <div class="aw-content-wrap clearfix">
                    <div class="col-sm-12 col-md-9 aw-main-content">
                        <div class="aw-mod clearfix">
                            <div class="mod-head common-head">
                                <h2 id="main_title">最新动态</h2>
                            </div>

                            <div class="mod-body aw-feed-list clearfix" id="main_contents">


                            </div>

                            <div class="mod-footer">


                            </div>
                        </div>
                    </div>
                    <!-- 侧边栏 -->
                    <div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm">

                        <div class="aw-mod side-nav">
                            <div class="mod-body">
                                <ul>
                                    <li><a href="{{ url('/dynamic') }}" class="active"><i class="icon icon-home"></i>最新动态</a></li>
                                    <li><a href="{{ url('/person/post') }}" ><i class="icon icon-home"></i>我的文章</a></li>
                                    <li><a href="{{ url('/person/answer') }}" ><i class="icon icon-home"></i>我的问答</a></li>
                                    <li><a href="{{ url('/person/video') }}"><i class="icon icon-draft"></i>我的视频</a></li>
                                    <li><a href="{{ url('/person/postCollect') }}"><i class="icon icon-favor"></i>我的收藏</a></li>
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