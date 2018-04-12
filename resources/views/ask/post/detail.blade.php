@extends('layouts.ask')
@section('content')

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
                                    <!-- 下拉菜单 -->
                                        <div class="btn-group pull-left">
                                            	<a class="btn btn-gray dropdown-toggle" data-toggle="dropdown" href="javascript:;">...</a>
                                                <div class="dropdown-menu aw-dropdown pull-right" role="menu" aria-labelledby="dropdownMenu">
                                                    <ul class="aw-dropdown-list">
                                                        <li>
                                                            <a href="javascript:;" onclick="">锁定文章</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;"  onclick="remove({{ $datas->post_id }});">删除文章</a>
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
                                             @if(!empty(Auth::id()))
                                                @if(Auth::id() == $datas->user_id)
                                                    <a class="text-color-999" href="{{ URL::action('Front\PostController@edit', ['id'=>$datas->post_id]) }}"><i class="icon icon-edit"></i>编辑</a>
                                                @endif()
                                            @endif()
                                            <a href="javascript:;" onclick="AWS.dialog(&#39;favorite&#39;, {item_id:2, item_type:&#39;article&#39;});" class="text-color-999"><i class="icon icon-favor"></i> 收藏</a>
                                            <a class="text-color-999 dropdown-toggle" data-toggle="dropdown"><i class="icon icon-share"></i>分享 </a>
                                            <div aria-labelledby="dropdownMenu" role="menu" class="aw-dropdown shareout pull-right">
                                                <ul class="aw-dropdown-list">
                                                    <li><a onclick="AWS.User.share_out({webid: &#39;tsina&#39;, content: $(this).parents(&#39;.aw-question-detail&#39;).find(&#39;.markitup-box&#39;)});"><i class="icon icon-weibo"></i> 微博</a></li>
        											<li><a onclick="AWS.User.share_out({webid: &#39;qzone&#39;, content: $(this).parents(&#39;.aw-question-detail&#39;)});"><i class="icon icon-qzone"></i> QZONE</a></li>
        											<li><a onclick="AWS.User.share_out({webid: &#39;weixin&#39;, content: $(this).parents(&#39;.aw-question-detail&#39;)});"><i class="icon icon-wechat"></i> 微信</a></li>
                                                </ul>
                                            </div>
                                            <em class="text-color-999">6 分钟前</em>
                                        </span>
                                    </div>
                            </div>
      						<div class="mod-footer"></div>
                        </div>
    
                        <!-- 文章评论 -->
                        <div class="aw-mod">
                            <div class="mod-head common-head">
                                <h2>0 个评论</h2>
                            </div>
                            <div class="mod-body aw-feed-list"></div>
    					</div>
                        <!-- end 文章评论 -->
    
                        <!-- 回复编辑器 -->
                        <div class="aw-mod aw-article-replay-box">
                            <a name="answer_form"></a>
                            <form action="" onsubmit="return false;" method="post" id="answer_form">
                                <input type="hidden" name="post_hash" value="b7fceca538cbf06aefb43a49c34aa3fd">
                                <input type="hidden" name="article_id" value="2">
                                <div class="mod-head">
                                    <a href="" class="aw-user-name"><img alt="admin" src="./post_detail_files/avatar-mid-img.png"></a>
                                </div>
                                <div class="mod-body">
                                    <textarea rows="3" name="message" id="comment_editor" class="form-control autosize" placeholder="写下你的评论..." style="overflow: hidden; word-wrap: break-word; resize: none; height: 74px;"></textarea>
                                </div>
                                <div class="mod-footer clearfix">
                                    <a href="javascript:;" onclick="AWS.ajax_post($(&#39;#answer_form&#39;), AWS.ajax_processer, &#39;reply&#39;);" class="btn btn-normal btn-success pull-right btn-submit btn-reply">回复</a>
                                </div>
                            </form>
                        </div>
                        <!-- end 回复编辑器 -->
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
<script type="text/javascript">
    function remove(id){
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
                            location.reload();
                        }else{
                            layer.msg(data.msg);
                        }
                    });
        },function(){});
    }
</script>
@stop
@endsection