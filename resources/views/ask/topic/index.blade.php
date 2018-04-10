@extends('layouts.ask')
@section('content')
<div class="aw-container-wrap">
    <div class="container">
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="col-sm-12 col-md-9 aw-main-content">
                    <!-- tab切换 -->
                    <ul class="nav nav-tabs aw-nav-tabs active hidden-xs">
                        <li><a href="">30 天</a></li>
                        <li><a href="">7 天</a></li>
                        <li class="active"><a href="">全部</a></li>
                        <h2 class="hidden-xs"><i class="icon icon-topic"></i>热门话题</h2>
                    </ul>
                    <!-- end tab切换 -->
                    <!-- 我关注的话题 -->
                    <div class="aw-mod aw-topic-list">
                        <div class="mod-body clearfix">
                        @foreach($tags as $tag )
                            <div class="aw-item">
                                <!-- 话题图片 -->
                                <a class="img aw-border-radius-5" href="{{ URL::action('Front\TopicController@detail', ['id'=>$tag->id]) }}" data-id="2">
                                    <img style="width:50px;" src="{{ $tag->thumb }}" alt="{{ $tag->name }}">
                                </a>
                                <!-- end 话题图片 -->
                                <p class="clearfix">
                                    <!-- 话题内容 -->
                                    <span class="topic-tag">
                                        <a class="text" href="{{ URL::action('Front\TopicController@detail', ['id'=>$tag->id]) }}" data-id="2">{{ $tag->name }}</a>
                                    </span>
                                    <!-- end 话题内容 -->
                                </p>
                                <p class="text-color-999">
                                    <span>1 个讨论</span>
                                    <span>1 个关注</span>
                                </p>
                                <p class="text-color-999">7 天新增 1 个讨论, 30 天新增 1 个讨论 </p>
                            </div>
                         @endforeach()

                        </div>
                        <div class="mod-footer clearfix">
                            <div class="paginate" style="text-align:center;">{{ $tags->links() }}</div>
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
                                        <a data-id="" class="img aw-border-radius-5" href="{{ URL::action('Front\TopicController@detail', ['id'=>$todayTag['id']]) }}">
                                            <img src="{{ $todayTag['thumb']  }}" alt="{{ $todayTag['name']  }}">
                                        </a>
                                        <!-- end 话题图片 -->
                                    </dt>
                                    <dd class="pull-left"></dd>
                                </dl>
                                <!-- 话题描述 -->
                                <p><span></span>...<a href="{{ URL::action('Front\TopicController@detail', ['id'=>$todayTag['id']]) }}">进入话题 »</a></p>
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
                 </div>
                <!-- end 侧边栏 -->
            </div>
        </div>
    </div>
</div>
@endsection