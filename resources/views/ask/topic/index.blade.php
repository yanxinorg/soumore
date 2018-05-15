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
        				<div class="aw-mod aw-topic-category">
                            <div class="mod-body clearfix">
                            <ul>
                                @if(empty($cid))
                                    <li><a class="active" href="{{ URL::action('Front\TopicController@index') }}">话题分类</a></li>
                                @else
                                    <li><a  href="{{ URL::action('Front\TopicController@index') }}">话题分类</a></li>
                                @endif
                                @foreach($cates as $cate)
                					@if($cate->id == $cid)
                					 <li ><a class="active" style="text-decoration:none;" href="{{ URL::action('Front\TopicController@cate', ['cid'=>$cate->id]) }}">{{ $cate->name }}</a></li>
                					@else
                					 <li><a style="text-decoration:none;" href="{{ URL::action('Front\TopicController@cate', ['cid'=>$cate->id]) }}">{{ $cate->name }}</a></li>
                					@endif
                        		@endforeach()
                          	</ul>
                            </div>
                    	</div>
                                	
                        <div class="mod-body clearfix">
                            @foreach($tags as $tag )
                                <div class="aw-item">
                                    <!-- 话题图片 -->
                                    <a class="img aw-border-radius-5" href="{{ URL::action('Front\TopicController@detail', ['id'=>$tag->id]) }}">
                                        <img style="width:50px;" src="{{ $tag->thumb }}" alt="{{ $tag->name }}">
                                    </a>
                                    <!-- end 话题图片 -->
                                    <p class="clearfix">
                                        <!-- 话题内容 -->
                                        <span class="topic-tag">
                                            <a class="text" href="{{ URL::action('Front\TopicController@detail', ['id'=>$tag->id]) }}">{{ $tag->name }}</a>
                                        </span>
                                        <!-- end 话题内容 -->
                                    </p>
                                    <p class="text-color-999">
                                        <span>{{ $tag->watchs }} 个关注</span>
                                        <span>{{ $tag->posts }} 个文章</span>
                                        <span>{{ $tag->questions }} 个问答</span>
                                        <span>{{ $tag->videos }} 个视频</span>
                                    </p>
                                </div>
                             @endforeach()

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