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

                            <div class="mod-body aw-feed-list clearfix">
                                @foreach($datas as $data)
                                    @if($data->source_action == '1')
                                    <div class="aw-item" >
                                        <div class="mod-head">
                                            <a class="aw-user-img aw-border-radius-5" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}"><img src="{{ $data->avator }}-sm_thumb_middle" /></a>
                                            <p class="text-color-999">
                                                <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" class="aw-user-name">{{ $data->author }}</a> 发表了文章 • {{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}
                                            </p>
                                            <h4><a href="{{ URL::action('Front\PostController@detail', ['id'=>$data->source_id]) }}">{{ $data->subject  }}</a></h4>
                                        </div>
                                    </div>
                                    @elseif($data->source_action == '2')
                                        <div class="aw-item" >
                                            <div class="mod-head">
                                                <a class="aw-user-img aw-border-radius-5" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}"><img src="{{ $data->avator }}-sm_thumb_middle" /></a>
                                                <p class="text-color-999">
                                                    <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" class="aw-user-name">{{ $data->author }}</a> 发布了问答 • {{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}
                                                </p>
                                                <h4><a href="{{ URL::action('Front\QuestionController@detail', ['id'=>$data->source_id]) }}">{{ $data->subject  }}</a></h4>
                                            </div>
                                        </div>
                                    @elseif($data->source_action == '3')
                                        <div class="aw-item" >
                                            <div class="mod-head">
                                                <a class="aw-user-img aw-border-radius-5" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}"><img src="{{ $data->avator }}-sm_thumb_middle" /></a>
                                                <p class="text-color-999">
                                                    <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" class="aw-user-name">{{ $data->author }}</a> 发布了视频 • {{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}
                                                </p>
                                                <h4><a href="{{ URL::action('Front\VideoController@detail', ['id'=>$data->source_id]) }}">{{ $data->subject  }}</a></h4>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="mod-footer clearfix">
                                <div class="paginate" style="text-align:center;">{!! $datas->links() !!}</div>
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