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
                                    <li><a href="{{ url('/person/post') }}"  ><i class="icon icon-home"></i>我的文章</a></li>
                                    <li><a href="{{ url('/person/answer') }}" ><i class="icon icon-home"></i>我的问答</a></li>
                                    <li><a href="{{ url('/person/video') }}" class="active"><i class="icon icon-draft"></i>我的视频</a></li>
                                    <li><a href="{{ url('/person/postCollect') }}"><i class="icon icon-favor"></i>我的收藏</a></li>
                                    <li><a href="{{ url('/person/topicAttention') }}" rel="focus_topic__focus"><i class="icon icon-mytopic"></i>我关注的话题</a></li>
                                    <li><a href="" rel="invite_list__invite"><i class="icon icon-invite"></i>邀请我回复的问题</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="aw-mod side-nav">
                            <div class="mod-body">
                                <ul>
                                    <li><a href="{{ url('/topic') }}"><i class="icon icon-topic"></i>所有话题</a></li>
                                    <li><a href="http://ask.com/?/people/"><i class="icon icon-user"></i>所有用户</a></li>
                                    <li><a href="http://ask.com/?/invitation/"><i class="icon icon-inviteask"></i>邀请好友加入 <em class="badge">10</em></a></li>
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
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick="AWS.User.follow($(this), &#39;user&#39;, 4);AWS.ajax_request(G_BASE_URL + &#39;/account/ajax/clean_user_recommend_cache/&#39;);"></a>
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
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick="AWS.User.follow($(this), &#39;user&#39;, 2);AWS.ajax_request(G_BASE_URL + &#39;/account/ajax/clean_user_recommend_cache/&#39;);"></a>
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
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick="AWS.User.follow($(this), &#39;user&#39;, 3);AWS.ajax_request(G_BASE_URL + &#39;/account/ajax/clean_user_recommend_cache/&#39;);"></a>
                                        <p class="signature"></p>
                                        <p></p>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt class="pull-left aw-border-radius-5">
                                        <a href="http://ask.com/?/topic/%E9%BB%98%E8%AE%A4%E8%AF%9D%E9%A2%98"><img alt="默认话题" src="./动态 - WeCenter_files/topic-mid-img.png"></a>
                                    </dt>
                                    <dd class="pull-left">
                                        <span class="topic-tag">
                                            <a href="http://ask.com/?/topic/%E9%BB%98%E8%AE%A4%E8%AF%9D%E9%A2%98" class="text">默认话题</a>
                                        </span>&nbsp;
                                        <a class="icon-inverse follow tooltips icon icon-plus" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="关注" onclick="AWS.User.follow($(this), &#39;topic&#39;, 1);AWS.ajax_request(G_BASE_URL + &#39;/account/ajax/clean_user_recommend_cache/&#39;);"></a>
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