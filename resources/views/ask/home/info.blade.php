@extends('layouts.ask')
@section('content')
    <style>
        .form-group{
            margin-top: 24px;
            padding: 12px 6px;
        }
    </style>
    <link  rel="stylesheet" type="text/css" href="{{ asset('ask/css/user.css') }}">
    <div class="aw-container-wrap">
        <div class="container1">
            <div class="row">
                <div class="aw-content-wrap clearfix">
                    <div class="col-sm-12 col-md-9 aw-main-content">
                        <!-- 用户数据内容 -->
                        <div class="aw-mod aw-user-detail-box">
                            <div class="mod-head">
                                <img style="width:100px;" src="{{ $userinfo['avator'] }}-sm_thumb_middle" onerror="this.src='{{ asset('ask/img/default_avator.jpg') }}'" >
                                @if(Auth::id() == $uid)
                                    <span class="pull-right operate">
                                    <a href="{{ url('/person/info') }}" class="btn btn-mini btn-success">编辑</a>
                                </span>
                                @elseif( $islooked )
                                    <span class="pull-right operate">
                                        <a class="text-color-999" href="{{ url('/person/sendLetter') }}"><i class="icon icon-inbox"></i> 私信</a>
                                        <a href="{{ URL::action('Front\AttentionController@cancelUser', ['uid'=>$uid]) }}" class="follow btn btn-normal btn-success active" ><span>取消关注</span></a>
                                    </span>
                                @else
                                    <span class="pull-right operate">
                                         <a href="{{ URL::action('Front\AttentionController@user', ['uid'=>$uid]) }}" class="follow btn btn-normal btn-success" ><span>关注</span> </a>
                                     </span>
                                @endif
                                <h1>{{ $userinfo->name }}</h1>
                                <p class="text-color-999">{{ $userinfo->bio }}</p>
                                <p class="aw-user-flag">
                                    @if(!empty($province))<span><i class="icon icon-location"></i> {{ $province }} {{ $city }}市</span>@endif
                                    @if(!empty($userinfo->occupation))  <span><i class="icon icon-job"></i> {{ $userinfo->occupation }}</span>@endif
                                </p>
                            </div>
                            <div class="mod-footer">
                                <ul class="nav nav-tabs aw-nav-tabs">
                                    <li><a href="{{ URL::action('Front\HomeController@index', ['uid'=>$uid]) }}">动态</a></li>
                                    <li><a href="{{ URL::action('Front\HomeController@post', ['uid'=>$uid]) }}">文章<span class="badge">{{ $countPost }}</span></a></li>
                                    <li><a href="{{ URL::action('Front\HomeController@question', ['uid'=>$uid]) }}">问答<span class="badge">{{ $countQuestion }}</span></a></li>
                                    <li ><a href="{{ URL::action('Front\HomeController@video', ['uid'=>$uid]) }}">视频<span class="badge">{{ $countVideo }}</span></a></li>
                                    <li ><a href="{{ URL::action('Front\HomeController@topicUser', ['uid'=>$uid]) }}">关注的人<span class="badge">{{  $countUsers }}</span></a></li>
                                    <li ><a href="{{ URL::action('Front\HomeController@topics', ['uid'=>$uid]) }}">关注的话题<span class="badge">{{ $countTopics }}</span></a></li>
                                    <li ><a href="{{ URL::action('Front\HomeController@topicedUser', ['uid'=>$uid]) }}">粉丝<span class="badge">{{ $countFans  }}</span></a></li>
                                    <li  class="active"><a href="{{ URL::action('Front\HomeController@info', ['uid'=>$uid]) }}" >详细资料</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- end 用户数据内容 -->
                        <div class="aw-user-center-tab">
                            <div class="tab-content">
                                <div class="tab-pane active">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if(!empty($userinfo->name))
                                                <div class="form-group">
                                                    <label  class="col-md-3 col-sm-2 control-label" >用户名</label>
                                                    <div class="col-md-9 col-sm-10">
                                                        <input type="text" class="form-control" value="{{ $userinfo->name }}" readonly>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($userinfo->realname))
                                                <div class="form-group">
                                                    <label  class="col-md-3 col-sm-2 control-label">真实姓名</label>
                                                    <div class="col-md-9 col-sm-10">
                                                        <input type="text" class="form-control" value="{{ $userinfo->realname }}" readonly>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($userinfo->email))
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-2 control-label">邮箱</label>
                                                    <div class="col-md-9 col-sm-8">
                                                        <input type="email" class="form-control" value="{{ $userinfo->email }}" readonly>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($userinfo->mobile))
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-2 control-label">手机号</label>
                                                    <div class="col-md-9 col-sm-10">
                                                        <input type="text" class="form-control" value="{{ $userinfo->mobile }}" readonly>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($userinfo->birthday))
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-2 control-label">生日</label>
                                                    <div class="col-md-9 col-sm-10" >
                                                        <input class="form-control form-control-inline input-medium default-date-picker" value="{{ $userinfo->birthday }}" readonly/>
                                                    </div>
                                                </div>
                                            @endif
                                             @if(!empty( $userinfo->qq))
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-2 control-label">QQ</label>
                                                    <div class="col-md-9 col-sm-10">
                                                        <input type="text" class="form-control" value="{{ $userinfo->qq }}" readonly>
                                                    </div>
                                                </div>
                                             @endif
                                             @if(!empty($userinfo->weixin))
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-2 control-label">微信号</label>
                                                    <div class="col-md-9 col-sm-10">
                                                        <input type="text" class="form-control" value="{{ $userinfo->weixin }}" readonly>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            @if(!empty( $province ))
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-2 control-label">所在城市</label>
                                                    <div class="col-md-9 col-sm-10">
                                                        <input type="text" class="form-control" value="{{ $province }}，{{ $city }}市" readonly>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($userinfo->graduateschool))
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-2 control-label">毕业院校</label>
                                                    <div class="col-md-9 col-sm-10">
                                                        <input type="text" class="form-control" value="{{ $userinfo->graduateschool }}" readonly>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!empty($userinfo->company))
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-2 control-label">公司名称</label>
                                                    <div class="col-md-9 col-sm-10">
                                                        <input type="text" class="form-control" value="{{ $userinfo->company }}" readonly>
                                                    </div>
                                                </div>
                                             @endif
                                             @if(!empty($userinfo->occupation))
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-2 control-label">职业</label>
                                                    <div class="col-md-9 col-sm-10">
                                                        <input type="text" class="form-control" value="{{ $userinfo->occupation }}" readonly>
                                                    </div>
                                                </div>
                                             @endif
                                             @if(!empty($userinfo->site))
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-2 control-label">个人主页</label>
                                                    <div class="col-md-9 col-sm-10">
                                                        <input type="url" class="form-control" value="{{ $userinfo->site }}" readonly>
                                                    </div>
                                                </div>
                                             @endif
                                             @if(!empty($userinfo->bio))
                                                <div class="form-group">
                                                    <label class="col-md-3 col-sm-2 control-label">个性签名</label>
                                                    <div class="col-md-9 col-sm-10">
                                                        <textarea rows="4" class="form-control" readonly>{{ $userinfo->bio }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 侧边栏 -->
                    <div class="col-sm-12 col-md-3 aw-side-bar">
                        <div class="aw-mod people-following">
                            <div class="mod-body">
                                <a href="{{ URL::action('Front\HomeController@topicUser', ['uid'=>$uid]) }}" class="pull-right font-size-12">更多 »</a>
                                <span>关注 <em class="aw-text-color-blue">{{  $countUsers }}</em>人</span>
                                <p>
                                    @foreach($topicUsers as $topicUser)
                                        <a class="aw-user-name" data-id="3" href="{{ URL::action('Front\HomeController@index', ['uid'=>$topicUser->user_id]) }}"><img src="{{ $topicUser->avator }}-sm_thumb_small" onerror="this.src='{{ asset('ask/img/default_avator.jpg') }}'"/></a>
                                    @endforeach()
                                </p>
                            </div>
                        </div>
                        <div class="aw-mod people-following">
                            <div class="mod-body">
                                <a href="{{ URL::action('Front\HomeController@topicedUser', ['uid'=>$uid]) }}" class="pull-right font-size-12">更多 »</a>
                                <span> 被 <em class="aw-text-color-blue">{{ $countFans  }}</em> 人关注</span>
                                <p>
                                    @foreach($fans as $fan)
                                        <a class="aw-user-name" data-id="3" href="{{ URL::action('Front\HomeController@index', ['uid'=>$fan->user_id]) }}"><img src="{{ $fan->avator }}-sm_thumb_middle" onerror="this.src='{{ asset('ask/img/default_avator.jpg') }}'"/></a>
                                    @endforeach()
                                </p>
                            </div>
                        </div>
                        <div class="aw-mod people-following">
                            <div class="mod-body">关注 <em class="aw-text-color-blue">{{ $countTopics }}</em> 话题 </div>
                            <div class="aw-topic-bar">
                                <div class="tag-bar clearfix">
                                    @foreach($topics as $topic)
                                        <span class="topic-tag"><a href="{{ URL::action('Front\TopicController@detail', ['id'=>$topic->tag_id]) }}" class="text" data-id="3">{{ $topic->tag_name }}</a></span>
                                    @endforeach()
                                </div>
                            </div>
                        </div>
                        <div class="aw-mod">
                            <div class="mod-body">
                                <span class="aw-text-color-666">最近访客</span>
                                <p>
                                    @foreach($recents as $recent)
                                        <a class="aw-user-name" data-id="3" href="{{ URL::action('Front\HomeController@index', ['uid'=>$recent->user_id]) }}"><img  src="{{ $recent->avator }}-sm_thumb_middle" onerror="this.src='{{ asset('ask/img/default_avator.jpg') }}'"></a>
                                    @endforeach()
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end 侧边栏 -->
                </div>
            </div>
        </div>
    </div>
@endsection