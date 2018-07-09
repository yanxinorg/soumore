@extends('layouts.ask')
@section('content')
    <?php
    use App\Models\Common\UserModel;
    ?>
    <style>
        .aw-question-detail{
            margin: 0 12px;
        }
    </style>
    <div class="aw-container-wrap">
        <div class="container1 " >
            <div class="row">
                <div class="aw-content-wrap clearfix ">
                    <div class="col-sm-12 col-md-9 aw-main-content aw-article-content">
                        <div class="aw-mod aw-topic-bar" data-type="article" >

                        </div>
                        <div class="aw-mod aw-question-detail " >
                            <div class="mod-head" >
                                <h2 style="font-weight: bold;">{{ $datas->name  }}</h2>
                            </div>
                            <div class="mod-body">
                                <div class="content" >
                                    <dl class="BotInfo"><p>文件大小：1.1&nbsp;MB</p>
                                        <p>文件数量：6</p>
                                        <p>创建日期：{{ substr($datas->create_time,0,10) }}</p>
                                        <p>索引日期：{{ substr($datas->last_seen,0,10) }}</p>
                                        <p>访问热度：{{ $datas->requests }}</p>
                                        <p>磁力下载：<a href="magnet:?xt=urn:btih:{{ $datas->info_hash }}">[磁力链接]</a></p>
                                        <p>文件列表：</p>
                                    </dl>
                                    <ol class="flist">
                                        <li>How to train your Python A hilarious way of learning to code with Python.zip<span>1.1&nbsp;MB</span></li>
                                        <li>[TGx]Downloaded from torrentgalaxy.org .txt<span>524&nbsp;字节</span></li>
                                        <li>Torrent downloaded from bt-scene.cc.txt<span>275&nbsp;字节</span></li>
                                        <li>Torrent Downloaded from Glodls.to.txt<span>237&nbsp;字节</span></li>
                                        <li>Torrent_downloaded_from_Demonoid_-_www.demonoid.pw_.txt<span>59&nbsp;字节</span></li>
                                        <li>[Bookflare.net] - Visit for more books.txt<span>29&nbsp;字节</span></li>
                                    </ol>
                                </div>
                                <div class="meta clearfix">
                                    <span class="pull-right  more-operate">
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

                        <!-- 文章评论 -->
                        <div class="aw-mod">

                            <div class="mod-head common-head">
                                <h2>16个评论</h2>
                            </div>

                            <div class="mod-body aw-feed-list">

                            </div>
                            <div class="paginate" style="text-align:center;"></div>
                        </div>
                        <!-- end 文章评论 -->
                    @auth()
                    <!-- 回复编辑器 -->
                        <div class="panel">
                            <div class="panel-body">
                                <form class="form-horizontal" method="post" action="{{ url('/post/comment') }}" id="Form">
                                    {{ csrf_field() }}
                                    <div class="form-group" hidden>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="user_id" value="{{ Auth::id() }}" >
                                        </div>
                                    </div>
                                    <div class="form-group" hidden>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="post_id" value="{{ $datas->id }}" >
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
                        @endauth
                    </div>
                    <!-- 侧边栏 -->
                    <div class="col-sm-12 col-md-3 aw-side-bar hidden-sm hidden-xs">
                        <div class="aw-mod user-detail">
                            <div class="mod-footer clearfix"></div>
                        </div>
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