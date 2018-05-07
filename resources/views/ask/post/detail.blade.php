@extends('layouts.ask')
@section('content')
@section('css')
@parent
<link href="{{ asset('ask/zoom/dist/zoomify.min.css') }}" rel="stylesheet">
@stop
<?php
use App\Models\Common\UserModel;
?>
<div class="aw-container-wrap">
    <div class="container">
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
                                                            <a href="javascript:;" onclick="">锁定文章</a>
                                                        </li>
                                                        <li>
                                                            <a  href="javascript:;" onclick="del({{ $datas->post_id }})">删除文章</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;" onclick="">推荐文章</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;" onclick="">添加到帮助中心</a>
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
                                        {!! $datas->content !!}
                                    </div>
                                    <div class="meta clearfix">
                                        <div class="aw-article-vote pull-left disabled">
                                            <a href="javascript:;" class="agree" onclick=""><i class="icon icon-agree"></i> <b>0</b></a>
                                        </div>
                                        <span class="pull-right  more-operate">
                                            @if(Auth::id() == $datas->user_id)
                                                <a class="text-color-999" href="{{ URL::action('Front\PostController@edit', ['id'=>$datas->post_id]) }}"><i class="icon icon-edit"></i>编辑</a>
                                            @endif()
                                            @if(!empty(Auth::id()))
                                                 @if($isCollected)
                                                     <a  href="javascript:;" onClick="collectCancel({{ $datas->post_id }});" class="text-color-999"><i class="icon icon-favor"></i>取消收藏</a>
                                                 @else
                                                     <a href="javascript:;" onClick="collect({{ $datas->post_id }});"  class="text-color-999"><i class="icon icon-favor"></i> 收藏</a>
                                                 @endif
                                            @endif()
                                            <a class="text-color-999 dropdown-toggle" data-toggle="dropdown"><i class="icon icon-share"></i>分享 </a>
                                            <div aria-labelledby="dropdownMenu" role="menu" class="aw-dropdown shareout pull-right">
                                                <ul class="aw-dropdown-list">
                                                    <li><a onclick="""><i class="icon icon-weibo"></i> 微博</a></li>
        											<li><a onclick=""><i class="icon icon-qzone"></i> QZONE</a></li>
        											<li><a onclick=""><i class="icon icon-wechat"></i> 微信</a></li>
                                                </ul>
                                            </div>
                                            <em class="text-color-999">{{\Carbon\Carbon::parse($datas->created_at)->diffForHumans()}}</em>
                                        </span>
                                    </div>
                            </div>
      						<div class="mod-footer"></div>
                        </div>
    
                        <!-- 文章评论 -->
                        <div class="aw-mod">
                            <div class="mod-head common-head">
                                <h2>{{ $datas->comments }}个评论</h2>
                            </div>
                            <div class="mod-body aw-feed-list">
                                @foreach($comments as $comment)
                                <div class="aw-item" id="answer_list_1">
                                    <div class="mod-head">
                                        <a class="aw-user-img aw-border-radius-5" href="{{ URL::action('Front\HomeController@index', ['uid'=>$comment->user_id]) }}">
                                            <img src="{{ route('getThumbImg', $comment->user_id ) }}" alt="{{ $comment->commentator }}">
                                        </a>
                                        <p>
                                            <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$comment->user_id]) }}">{{ $comment->commentator }}</a>
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
                                            <a class="text-color-999 " onclick="AWS.User.article_comment_vote($(this), 1, 1)"><i class="icon icon-agree"></i> 0 赞</a>
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
                            <form class="form-horizontal" method="post" action="{{ url('/comment/create') }}" id="Form">
                                {{ csrf_field() }}
                                <div class="form-group" hidden>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="user_id" value="{{ Auth::id() }}" >
                                    </div>
                                </div>
                                <div class="form-group" hidden>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="post_id" value="{{ $datas->post_id }}" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea rows="4" class="form-control" name="comment" id="comment" placeholder="写下你的评论..."></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-10 col-md-6">
                                        <button type="submit" class="btn btn-primary">提交评论</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

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
                                        <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$datas->user_id]) }}"><img alt="{{ $datas->author }}" src="{{ route('getThumbImg', $datas->user_id) }}"></a>
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
<script src="{{ asset('ask/zoom/dist/zoomify.min.js') }}"></script>
<script type="text/javascript">
    //图片放大
    $(document).ready(function(){
        $('.content img').zoomify();
    });
    function del(id){
        layer.confirm('确认删除该文章？', {
            btn: ['确认','取消'] //按钮
        },function(){
            $.post("{{ url('/post/del') }}",
                    {
                        "_token":'{{ csrf_token() }}',
                        "id": id,
                    },function(data){
                        if(data.code)
                        {
                            layer.msg(data.msg);
                            window.location.href=("{{ url('/post')  }}");
                        }else{
                            layer.msg(data.msg);
                        }
                    });
        },function(){});
    }

    // 文章收藏
    function collect(id){
        $.post("{{ url('/post/collect') }}",
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
        $.post("{{ url('/post/collectCancel') }}",
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

</script>
@stop
@endsection