@extends('layouts.ask')
@section('content')
    <style>
        .aw-topic-list .aw-item .img {
            position: static;
            left: 5px;
            top: 20px;
        }
        .aw-topic-list .aw-item {
            width: auto;
            padding: 20px 15px 20px 15px;
        }
        p{
            margin: 0px;
        }
        .aw-topic-list .aw-item p + p {
            margin: 0px;
        }
    </style>
    <div class="aw-container-wrap">
        <div class="container1">
            <div class="row">
                <div class="aw-content-wrap clearfix">
                    <div class="col-sm-12 col-md-9 aw-main-content">
                        <!-- tab切换 -->
                        <ul class="nav nav-tabs aw-nav-tabs active hidden-xs">
                            <h2 class="hidden-xs"><i class="icon icon-topic"></i>视频锦集</h2>
                        </ul>
                        <!-- end tab切换 -->
                        <!-- 我关注的话题 -->
                        <div class="aw-mod aw-topic-list ">
                            <div class="aw-mod aw-topic-category">
                                <div class="mod-body clearfix">
                                    <ul>
                                        @if(empty($cid))
                                            <li><a class="active" href="{{ URL::action('Front\VideoController@index') }}">视频分类</a></li>
                                        @else
                                            <li><a  href="{{ URL::action('Front\VideoController@index') }}">视频分类</a></li>
                                        @endif
                                        @foreach($cates as $cate)
                                            @if($cate->id == $cid)
                                                <li ><a class="active" style="text-decoration:none;" href="{{ URL::action('Front\VideoController@cate', ['cid'=>$cate->id]) }}">{{ $cate->name }}</a></li>
                                            @else
                                                <li><a style="text-decoration:none;" href="{{ URL::action('Front\VideoController@cate', ['cid'=>$cate->id]) }}">{{ $cate->name }}</a></li>
                                            @endif
                                        @endforeach()
                                    </ul>
                                </div>
                            </div>

                            <div class="mod-body clearfix" >
                                @foreach($videos as $video )
                                    <div class="aw-item">
                                        <a class="img aw-border-radius-5" href="{{ URL::action('Front\VideoController@detail', ['id'=>$video->id]) }}">
                                            <img style="width:180px;height: 120px;" src="{{ $video->thumb }}" alt="{{ $video->title }}">
                                        </a>
                                        <p class="clearfix" style="margin-top: 12px;">
                                            <a class="text" href="{{ URL::action('Front\VideoController@detail', ['id'=>$video->id]) }}">{{ str_limit($video->title,20) }}</a>
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
                            <div class="mod-footer clearfix">
                                <div class="paginate" style="text-align:center;">{!! $videos->appends(array('cid'=>$cid))->render() !!}</div>
                            </div>
                        </div>
                        <!-- end 我关注的话题 -->
                    </div>
                    <!-- 侧边栏 -->
                    <div class="col-sm-3 col-md-3 aw-side-bar hidden-sm hidden-xs">
                        <!-- 新增话题 -->
                        <div class="aw-mod new-topic">
                            <div class="mod-head">
                                <h3>相关话题</h3>
                            </div>
                            <div class="mod-body clearfix">
                                <div class="aw-topic-bar">
                                    <div class="topic-bar clearfix">
                                        @foreach($tags as $tag)
                                            <span class="topic-tag">
                                                <a class="text" href="{{ URL::action('Front\TopicController@detail', ['id'=>$tag->id]) }}">{{ $tag->name }}</a>
                                            </span>
                                        @endforeach()
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end 新增话题 -->
                    </div>
                    <!-- end 侧边栏 -->
                </div>
            </div>
        </div>
    </div>
@endsection