@extends('layouts.ask')
@section('content')
@section('css')
    <style>
        video::-internal-media-controls-download-button {
            display:none;
        }

        video::-webkit-media-controls-enclosure {
            overflow:hidden;
        }

        video::-webkit-media-controls-panel {
            width: calc(100% + 30px);
        }
        .aw-article-content .aw-question-detail h1 {
            max-width: 90%;
        }
    </style>
    @parent
    <link href="{{ asset('ask/zoom/dist/zoomify.min.css') }}" rel="stylesheet">
@stop
<?php
use App\Models\Common\UserModel;
?>
<div class="aw-container-wrap">
    <div class="container1" >
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="col-sm-12 col-md-9 aw-main-content aw-article-content">
                    <div class="aw-mod aw-topic-bar" data-type="article" >
                        <div class="tag-bar clearfix">
                            @if(!empty($tagss))
                                @foreach($tagss as $tag)
                                    <span class="topic-tag" data-id="3"><a class="text" href="{{ URL::action('Front\TopicController@detail', ['id'=>$tag->id]) }}">{{ $tag->name  }}</a></span>
                                @endforeach()
                            @else
                                <span class="icon-inverse aw-edit-topic"><i class="icon icon-edit"></i> 添加话题</span>
                            @endif
                        </div>
                    </div>

                    <div class="aw-mod aw-question-detail">
                        <div class="mod-head">
                            <h1>{{ $datas->title  }}</h1>
                            <div class="operate clearfix">
                             @if($datas->user_id == Auth::id())
                                <!-- 下拉菜单 -->
                                    <div class="btn-group pull-left">
                                        <a class="btn btn-gray dropdown-toggle" data-toggle="dropdown" href="javascript:;">...</a>
                                        <div class="dropdown-menu aw-dropdown pull-right" aria-labelledby="dropdownMenu">
                                            <ul class="aw-dropdown-list">
                                                <li>
                                                    <a href="{{ URL::action('Front\VideoController@edit', ['id'=>$datas->video_id]) }}" >编辑视频</a>
                                                </li>
                                                <li>
                                                    <a  href="javascript:;" onclick="del({{ $datas->video_id }})">删除视频</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- end 下拉菜单 -->
                                @endif
                            </div>
                        </div>
                        <div class="mod-body">
                            <div class="content markitup-box">
                                <embed src='{{ $datas->url }}' allowFullScreen='true' quality='high' width='100%' height='600' align='middle' allowScriptAccess='always' type='application/x-shockwave-flash'></embed>
                            </div>
                            <div class="meta clearfix">
                                <div class="content markitup-box">
                                    {!! $datas->excerpt !!}
                                </div>
                            </div>

                            <div class="meta clearfix">
                                @auth()
                                <div class="aw-article-vote pull-left ">
                                    @if($isSupported)
                                        <a class="agree active" href="{{ URL::action('Front\SupportController@video', ['video_id'=>$datas->video_id,'user_id'=>Auth::id()]) }}" ><i class="icon icon-agree"></i> <b>{{ $supports }}</b></a>
                                    @else
                                        <a href="{{ URL::action('Front\SupportController@video', ['video_id'=>$datas->video_id,'user_id'=>Auth::id()]) }}" class="agree"><i class="icon icon-agree"></i> <b>{{ $supports }}</b></a>
                                    @endif
                                </div>
                                @endauth
                                <span class="pull-right  more-operate">
                                        @if(Auth::id() == $datas->user_id)
                                            <a class="text-color-999" href="{{ URL::action('Front\VideoController@edit', ['id'=>$datas->video_id]) }}"><i class="icon icon-edit"></i>编辑</a>
                                        @endif()
                                        @if(!empty(Auth::id()))
                                            @if($isCollected)
                                                <a  href="javascript:;" onClick="collectCancel({{ $datas->video_id }});" class="text-color-999"><i class="icon icon-favor"></i>取消收藏</a>
                                            @else
                                                <a href="javascript:;" onClick="collect({{ $datas->video_id }});"  class="text-color-999"><i class="icon icon-favor"></i> 收藏</a>
                                            @endif
                                        @endif()
                                        <a class="text-color-999 dropdown-toggle" data-toggle="dropdown"><i class="icon icon-share"></i>分享 </a>
                                                <div aria-labelledby="dropdownMenu" role="menu" class="aw-dropdown shareout pull-right">
                                                    <ul class="aw-dropdown-list" >
                                                        <li><a ><i class="icon icon-weibo"></i> 微博</a></li>
                                                        <li ><a ><i class="icon icon-qzone"></i> QZONE</a></li>
                                                        <li><a><i class="icon icon-wechat"></i> 微信</a></li>
                                                    </ul>
                                                </div>
                                    <em class="text-color-999">{{\Carbon\Carbon::parse($datas->created_at)->diffForHumans()}}</em>
                                </span>
                            </div>
                        </div>
                        <div class="mod-footer"></div>
                    </div>

                    <!-- 视频评论 -->
                    <div class="aw-mod">

                        <div class="mod-head common-head">
                            <h2>{{ $datas->comments }}个评论</h2>
                        </div>

                        <div class="mod-body aw-feed-list">
                            @foreach($comments as $comment)
                                <div class="aw-item" id="answer_list_1">
                                    <div class="mod-head">
                                        <a class="aw-user-img aw-border-radius-5" href="{{ URL::action('Front\HomeController@index', ['uid'=>$comment->user_id]) }}">
                                            <img src="{{ $comment->avator }}">
                                        </a>
                                        <p>
                                            @if($comment->user_id == $datas->user_id)
                                                <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$comment->user_id]) }}">作者</a>
                                            @else
                                                <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$comment->user_id]) }}">{{ $comment->commentator }}</a>
                                            @endif

                                            @if(!empty($comment->to_user_id))
                                                <span >回复</span>
                                                <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$comment->to_user_id]) }}">
                                                    @php echo (UserModel::where('id',$comment->to_user_id)->pluck('name'))[0]; @endphp
                                                </a>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="mod-body">
                                        <div class="markitup-box"> {{ $comment->content }}</div>
                                    </div>
                                    <div class="mod-footer">
                                        <div class="meta">
                                            <span class="pull-right text-color-999">{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
                                            <a class="text-color-999 " onclick=""><i class="icon icon-agree"></i> 0 赞</a>
                                            @if($comment->user_id !== Auth::id() )
                                                <a href="javascript:void(0);" class="aw-article-comment text-color-999" data-id="1" onclick="reply({{ $comment->user_id }},'{{ $comment->commentator }}')"><i class="icon icon-comment"></i> 回复</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="paginate" style="text-align:center;">{!! $comments->appends(array('id'=>$id))->render() !!}</div>
                    </div>
                    <!-- end 文章评论 -->

                    <!-- 回复编辑器 -->
                    <div class="panel">
                        <div class="panel-body">
                            <form class="form-horizontal" method="post" action="{{ url('/video/comment') }}" id="Form">
                                {{ csrf_field() }}
                                <div class="form-group" hidden>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="user_id" value="{{ Auth::id() }}" >
                                    </div>
                                </div>
                                <div class="form-group" hidden>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="video_id" value="{{ $datas->video_id }}" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea rows="4" class="form-control" name="comment" id="comment" placeholder="写下你的评论..." required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group col-md-2 ">
                                         <span class="input-group-btn ">
                                             <input type="text" class="form-control InputCaptcha"  style="margin-left: 15px;" name="captcha" placeholder="验证码" required>
                                                <a onclick="javascript:re_captcha();" >
                                                   <img src="{{ url('/captcha/1') }}" style="max-height: 34px;" alt="验证码" title="刷新图片" class="InputImg"  id="c2c98f0de5a04167a9e427d883690ff6" border="0">
                                                </a>
                                         </span>
                                    </div>
                                    <div class="col-md-offset-10 col-md-2">
                                        <button type="submit" class="btn btn-primary ">提交评论</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- 回复编辑器 -->
                </div>


                <!-- 侧边栏 -->
                <div class="col-sm-12 col-md-3 aw-side-bar hidden-sm hidden-xs">
                    <!-- 发起人 -->
                    <div class="aw-mod user-detail">
                        <div class="mod-head">
                            <h3>发起人</h3>
                        </div>
                        <div class="mod-body">
                            <dl>
                                <dt class="pull-left aw-border-radius-5">
                                    <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$datas->user_id]) }}"><img src="{{ $datas->avator }}-sm_thumb_small"></a>
                                </dt>
                                <dd class="pull-left">
                                    <a class="aw-user-name" href="{{ URL::action('Front\HomeController@index', ['uid'=>$datas->user_id]) }}" data-id="1">{{ $datas->author }}</a>
                                    <p></p>
                                </dd>
                            </dl>
                        </div>
                        <div class="mod-footer clearfix"></div>
                    </div>
                    <!-- end 发起人 -->
                </div>
                <!-- end 侧边栏 -->


            </div>
        </div>
    </div>
</div>
@section('js')
@parent
<script type="text/javascript" src="{{ asset('ask/layer/layer.js') }}" ></script>
<script type="text/javascript">
    function del(id){
        layer.confirm('确认删除该视频？', {
            btn: ['确认','取消'] //按钮
        },function(){
            $.post("{{ url('/video/del') }}",
                    {
                        "_token":'{{ csrf_token() }}',
                        "id": id,
                    },function(data){
                        if(data.code)
                        {
                            layer.msg(data.msg);
                            window.location.href=("{{ url('/video')  }}");
                        }else{
                            layer.msg(data.msg);
                        }
                    });
        },function(){});
    }

    // 视频收藏
    function collect(id){
        $.post("{{ url('/video/collect') }}",
                {
                    "_token":'{{ csrf_token() }}',
                    "id": id,
                },function(data){
                    if(data.code == 1)
                    {
                        layer.msg(data.msg);
                        location.reload() ;
                    }else{
                        if(data.code == 2)
                        {
                            layer.msg(data.msg);
                            location.reload();
                        }else{
                            layer.msg(data.msg);
                            location.reload();
                        }
                    }
                });
    }
    //取消收藏
    function collectCancel(id){
        $.post("{{ url('/video/collectCancel') }}",
                {
                    "_token":'{{ csrf_token() }}',
                    "id": id,
                },function(data){
                    if(data.code)
                    {
                        layer.msg(data.msg);
                        location.reload() ;
                    }else{
                        layer.msg(data.msg);
                    }
                });
    }
    //评论回复
    function reply($userId,$userName)
    {
        location.href = "#Form";
        $("#comment").attr("placeholder","回复"+$userName);
        var myform=$('#Form'); //得到form对象
        var tmpInput=$("<input type='hidden' name='to_user_id' />");
        tmpInput.attr("value", $userId);
        myform.append(tmpInput);
    }
    //验证码
    function re_captcha() {
        $url = "{{ url('/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
    }
</script>
@stop
@endsection