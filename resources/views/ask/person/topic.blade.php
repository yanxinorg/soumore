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
                                    <li><a href="{{ URL::action('Front\PersonController@post', ['status'=>'1']) }}"  ><i class="icon icon-home"></i>我的文章</a></li>
                                    <li><a href="{{ url('/person/answer') }}" ><i class="icon icon-home"></i>我的问答</a></li>
                                    <li><a href="{{ URL::action('Front\PersonController@post', ['status'=>'0']) }}"><i class="icon icon-draft"></i>我的草稿</a></li>
                                    <li><a href="{{ url('/person/postCollect') }}"><i class="icon icon-favor"></i>我的收藏</a></li>
                                    <li><a href="{{ url('/person/topicAttention') }}" class="active"><i class="icon icon-mytopic"></i>我关注的话题</a></li>
                                    <li><a href="" rel="invite_list__invite"><i class="icon icon-invite"></i>邀请我回复的问题</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="aw-mod side-nav">
                            <div class="mod-body">
                                <ul>
                                    <li><a href="{{ url('/topic') }}"><i class="icon icon-topic"></i>所有话题</a></li>
                                    <li><a href=""><i class="icon icon-user"></i>所有用户</a></li>
                                    <li><a href=""><i class="icon icon-inviteask"></i>邀请好友加入 <em class="badge">10</em></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- 可能感兴趣的人/或话题 -->
                        <div class="aw-mod interest-user">
                            <div class="mod-head"><h3>可能感兴趣的人或话题</h3></div>
                            <div class="mod-body">
                                <dl>
                                    <dt class="pull-left aw-border-radius-5">
                                        <a href="http://ask.com/?/people/admin" data-id="4" class="aw-user-name"><img alt="admin" src="./动态 - WeCenter_files/avatar-min-img.png"></a>
                                    </dt>
                                    <dd class="pull-left">
                                        <a href="http://ask.com/?/people/admin" data-id="4" class="aw-user-name"><span>admin</span></a>
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick=""></a>
                                        <p class="signature"></p>
                                        <p></p>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt class="pull-left aw-border-radius-5">
                                        <a href="http://ask.com/?/people/admin" data-id="2" class="aw-user-name"><img alt="admin" src="./动态 - WeCenter_files/avatar-min-img.png"></a>
                                    </dt>
                                    <dd class="pull-left">
                                        <a href="http://ask.com/?/people/admin" data-id="2" class="aw-user-name"><span>admin</span></a>
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick=""></a>
                                        <p class="signature"></p>
                                        <p></p>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt class="pull-left aw-border-radius-5">
                                        <a href="http://ask.com/?/people/admin" data-id="3" class="aw-user-name"><img alt="admin" src="./动态 - WeCenter_files/avatar-min-img.png"></a>
                                    </dt>
                                    <dd class="pull-left">
                                        <a href="http://ask.com/?/people/admin" data-id="3" class="aw-user-name"><span>admin</span></a>
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick=""></a>
                                        <p class="signature"></p>
                                        <p></p>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt class="pull-left aw-border-radius-5">
                                        <a href=""><img alt="默认话题" src="./动态 - WeCenter_files/topic-mid-img.png"></a>
                                    </dt>
                                    <dd class="pull-left">
                                        <span class="topic-tag">
                                            <a href="" class="text">默认话题</a>
                                        </span>&nbsp;
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick=""></a>
                                        <p></p>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <!-- end 侧边栏 -->
                </div>
            </div>
        </div>
    </div>

@endsection