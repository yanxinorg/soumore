@extends('layouts.ask')
@section('content')
<style>
    li {
        list-style-type:none;
    }
</style>
    <div class="aw-container-wrap">
        <div class="container1">
            <div class="row">
                <div class="aw-content-wrap clearfix">
                    <div class="col-sm-12 col-md-9 aw-main-content">
                        <div class="aw-mod clearfix">
                            <div class="mod-head common-head">
                                <h2 id="main_title">最新文章</h2>
                            </div>

                            <div class="mod-body aw-feed-list clearfix" >

                                <div class="aw-mod aw-topic-category">
                                    <div class="mod-body clearfix">
                                        <ul>
                                            @if(empty($cid) && $status !== '0')
                                                <li><a class="active" href="{{ url('/person/video') }}">全部分类</a></li>
                                            @else
                                                <li><a href="{{ url('/person/video') }}">全部分类</a></li>
                                            @endif
                                            @foreach($cates as $cate)
                                                @if($cate->id == $cid && $status !== '0')
                                                    <li ><a class="active" style="text-decoration:none;" href="{{ URL::action('Front\PersonController@video', ['cid'=>$cate->id]) }}">{{ $cate->name }}</a></li>
                                                @else
                                                    <li><a style="text-decoration:none;" href="{{ URL::action('Front\PersonController@video', ['cid'=>$cate->id]) }}">{{ $cate->name }}</a></li>
                                                @endif
                                            @endforeach()
                                            @if($status == '0')
                                                <li><a class="active"  style="text-decoration:none;" href="{{ URL::action('Front\PersonController@video', ['cid'=>'','status'=>'0']) }}">未发布</a></li>
                                            @else
                                                <li><a style="text-decoration:none;" href="{{ URL::action('Front\PersonController@video', ['cid'=>'','status'=>'0']) }}">未发布</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 24px;">
                                    @foreach($videos as $video )
                                        <div class="col-md-3" style="margin-bottom: 24px;">
                                            <a class="img aw-border-radius-5" href="{{ URL::action('Front\VideoController@detail', ['id'=>$video->id]) }}">
                                                <img style="width:180px;height: 120px;" src="{{ $video->thumb }}" alt="{{ $video->title }}">
                                            </a>

                                            <p class="clearfix">
                                            <li><a class="text" href="{{ URL::action('Front\VideoController@detail', ['id'=>$video->id]) }}">{{ str_limit($video->title,24) }}</a></li>
                                            <li class="text-color-999">
                                                <span>发布时间：{{ substr($video->created_at,0,11) }}</span>
                                                @if(!$video->status)
                                                    <span class="topic-tag"><a class="text" style="background-color: red;" >未发布</a></span>
                                                @endif
                                            </li>
                                            </p>
                                        </div>
                                    @endforeach()
                                </div>
                                <div class="mod-footer">
                                    <div class="paginate" style="text-align:center;">{!! $videos->appends(array('cid'=>$cid,'status'=>$status))->render() !!}</div>
                                </div>
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
                                    <li><a href="{{ url('/person/video') }}" class="active"><i class="icon icon-draft"></i>我的视频</a></li>
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