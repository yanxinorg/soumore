@extends('layouts.ask')
@section('content')
<div class="aw-container-wrap">
    <div class="container1">
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="col-sm-12 col-md-9 aw-main-content">
                    <!-- tab切换 -->
                    <ul class="nav nav-tabs aw-nav-tabs active hidden-xs">
                        <h2 class="hidden-xs"><i class="icon icon-topic"></i>热门话题</h2>
                    </ul>
                    <!-- end tab切换 -->
                    <!-- 我关注的话题 -->
                    <div class="aw-mod aw-topic-list">
                        <div class="mod-body clearfix">
                            <div class="row">
                                @foreach($tags as $tag )
                                    <div class="col-md-6" style="margin-top: 16px;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <a class="img aw-border-radius-5" href="{{ URL::action('Front\TopicController@detail', ['id'=>$tag->id]) }}">
                                                    <img style="width:100%;" src="{{ $tag->thumb }}" alt="{{ $tag->name }}">
                                                </a>
                                            </div>
                                            <div class="col-md-9">
                                                <p class="clearfix" >
                                                    <a class="text" href="{{ URL::action('Front\TopicController@detail', ['id'=>$tag->id]) }}">{{ $tag->name }}</a>
                                                </p>
                                                <p class="text-color-999">
                                                    <span>{{ $tag->watchs }} 个关注</span>
                                                    <span> • </span>
                                                    <span>{{ $tag->posts }} 个文章</span>
                                                    <span> • </span>
                                                    <span>{{ $tag->questions }} 个问答</span>
                                                    <span> • </span>
                                                    <span>{{ $tag->videos }} 个视频</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach()
                            </div>
                        </div>
                        <div class="mod-footer clearfix">
                            <div class="paginate" style="text-align:center;">{!! $tags->appends(array('cid'=>$cid))->render() !!}</div>
                        </div>
                    </div>
                    <!-- end 我关注的话题 -->
                </div>
                <!-- 侧边栏 -->
                <div class="col-sm-3 col-md-3 aw-side-bar hidden-sm hidden-xs">
                        <!-- 今日话题 -->
                        <div class="aw-mod topic-daily hidden-xs">
                            <div class="mod-head">
                                <h3>今日话题</h3>
                            </div>
                            <div class="mod-body">
                                <dl>
                                    <dt class="pull-left">
                                        <!-- 话题图片 -->
                                        @if(!empty($todayTag))
                                        <a data-id="" class="img aw-border-radius-5" href="{{ URL::action('Front\TopicController@detail', ['id'=>$todayTag['id']]) }}">
                                            <img src="{{ $todayTag['thumb']  }}" alt="{{ $todayTag['name']  }}">
                                        </a>
                                        @endif
                                        <!-- end 话题图片 -->
                                    </dt>
                                    <dd class="pull-left"></dd>
                                </dl>
                                <!-- 话题描述 -->
                                @if(!empty($todayTag))
                                    <p><a href="{{ URL::action('Front\TopicController@detail', ['id'=>$todayTag['id']]) }}">新增话题 »</a></p>
                                @endif
                                <!-- end 话题描述 -->
                            </div>
                        </div>
                        <!-- end 今日话题 -->
                        <!-- 新增话题 -->
                        <div class="aw-mod new-topic">
                            <div class="mod-head">
                                <h3>新增话题</h3>
                            </div>
                            <div class="mod-body clearfix">
                                <div class="aw-topic-bar">
                                    <div class="topic-bar clearfix">
                                    	@foreach($tags as $tag)
                                        <span class="topic-tag">
                                            <a class="text" href="{{ URL::action('Front\TopicController@detail', ['id'=>$tag->id]) }}" >{{ $tag->name }}</a>
                                        </span>
                                        @endforeach()
                                   </div>
                                </div>
                            </div>
                        </div>
                        <!-- end 新增话题 -->
                        <!-- 话题分类 -->
                        <div class="aw-mod new-topic">
                            <div class="mod-head">
                                <h3>话题分类</h3>
                            </div>
                            <div class="mod-body clearfix">
                                <div class="aw-topic-bar">
                                    <div class="topic-bar clearfix">
                                        @if(empty($cid))
                                            <span class="topic-tag"><a class="text active" style="background-color: red;" href="{{ URL::action('Front\TopicController@index') }}">话题分类</a></span>
                                        @else
                                            <span class="topic-tag"><a  class="text" href="{{ URL::action('Front\TopicController@index') }}">话题分类</a></span>
                                        @endif
                                        @foreach($cates as $cate)
                                            @if($cate->id == $cid)
                                                <span class="topic-tag"><a class="text active" style="text-decoration:none;background-color: red;" href="{{ URL::action('Front\TopicController@cate', ['cid'=>$cate->id]) }}">{{ $cate->name }}</a></span>
                                            @else
                                                <span class="topic-tag"><a class="text" style="text-decoration:none;" href="{{ URL::action('Front\TopicController@cate', ['cid'=>$cate->id]) }}">{{ $cate->name }}</a></span>
                                            @endif
                                        @endforeach()
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end 话题分类 -->
                 </div>
                <!-- end 侧边栏 -->
            </div>
        </div>
    </div>
</div>
@endsection