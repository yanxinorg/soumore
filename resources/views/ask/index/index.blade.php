@extends('layouts.ask')
@section('content')
   <div class="aw-container-wrap">
      @if(empty(Auth::id()))
      <div class="jumbotron text-center hidden-xs">
         <h4>欢迎加入SOUMORE问答社区，QQ群①：627375769</h4>
            <a class="btn btn-primary ml-10" href="{{ url('/register') }}" role="button">立即注册</a> <a class="btn btn-default ml-5" href="{{ url('/login') }}" role="button">用户登录</a>
      </div>
      @endif
      <div class="container1" >

         <div class="row">

            <div class="aw-content-wrap clearfix">
               <!-- 文章 -->
               <div class="col-sm-12 col-md-4 aw-side-bar">
                  {{--热门文章--}}
                  <div class="aw-mod new-topic">
                     <div class="mod-head">
                        <a href="{{ url('/post/hot')  }}" class="pull-right">更多 &gt;</a>
                        <h3>热门文章</h3>
                     </div>
                     <div class="mod-body">
                        <div class="topic-bar clearfix">
                           <div class="aw-common-list">
                              @foreach($hotPost as $data)
                                 <div class="aw-item article" data-topic-id="3,">
                                    <a class="aw-user-name hidden-xs" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" rel="nofollow"><img src="{{ $data->avator }}-sm_thumb_middle" /></a>
                                    <div class="aw-question-content">
                                       <h4><a href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ $data->title }}</a></h4>
                                       <p>
                                          <a class="aw-question-tags" href="{{ URL::action('Front\PostController@cate',['cid'=>$data->cate_id]) }}">{{ $data->cate_name }}</a>
                                          <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" class="aw-user-name">{{ $data->author }}</a> <span class="text-color-999">发表了文章 • {{ $data->countcomment }} 个评论 • {{ $data->hits }} 次浏览 • {{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
                                       </p>
                                    </div>
                                 </div>
                              @endforeach()
                           </div>
                        </div>
                     </div>
                  </div>
                  {{--推荐文章--}}
                  <div class="aw-mod new-topic">
                     <div class="mod-head">
                        <a href="{{ url('/post/recom') }}" class="pull-right">更多 &gt;</a>
                        <h3>推荐文章</h3>
                     </div>
                     <div class="mod-body">
                        <div class="topic-bar clearfix">
                           <div class="aw-common-list">
                              @foreach($recomPost as $data)
                                 <div class="aw-item article" data-topic-id="3,">
                                    <a class="aw-user-name hidden-xs" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" rel="nofollow"><img src="{{ $data->avator }}-sm_thumb_middle" /></a>
                                    <div class="aw-question-content">
                                       <h4><a href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ $data->title }}</a></h4>
                                       <p>
                                          <a class="aw-question-tags" href="{{ URL::action('Front\PostController@cate',['cid'=>$data->cate_id]) }}">{{ $data->cate_name }}</a>
                                          <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" class="aw-user-name">{{ $data->author }}</a> <span class="text-color-999">发表了文章 • {{ $data->countcomment }} 个评论 • {{ $data->hits }} 次浏览 • {{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
                                       </p>
                                    </div>
                                 </div>
                              @endforeach()
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- 最新文章 -->
                  <div class="aw-mod new-topic">
                     <div class="mod-head">
                        <a href="{{ url('/post') }}" class="pull-right">更多 &gt;</a>
                        <h3>最新文章</h3>
                     </div>
                     <div class="mod-body clearfix">
                        <div class="aw-topic-bar">
                           <div class="aw-common-list">
                              @foreach($latestPost as $data)
                                 <div class="aw-item article" data-topic-id="3,">
                                    <a class="aw-user-name hidden-xs" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" rel="nofollow"><img src="{{ $data->avator }}-sm_thumb_middle" /></a>
                                    <div class="aw-question-content">
                                       <h4><a href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ $data->title }}</a></h4>
                                       <p>
                                          <a class="aw-question-tags" href="{{ URL::action('Front\PostController@cate',['cid'=>$data->cate_id]) }}">{{ $data->cate_name }}</a>
                                          <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" class="aw-user-name">{{ $data->author }}</a> <span class="text-color-999">发表了文章 • {{ $data->countcomment }} 个评论 • {{ $data->hits }} 次浏览 • {{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
                                       </p>
                                    </div>
                                 </div>
                              @endforeach()
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end 最新文章 -->

               </div>
               <!-- end 文章 -->

               <!-- 话题 -->
               <div class="col-sm-12 col-md-4 aw-side-bar">
                  <!-- 最新问答 -->
                  <div class="aw-mod new-topic">
                     <div class="mod-head">
                        <a href="{{ url('/question') }}" class="pull-right">更多 &gt;</a>
                        <h3>最新问答</h3>
                     </div>
                     <div class="mod-body clearfix">
                        <div class="aw-topic-bar">
                           <div class="aw-common-list">
                              @foreach( $latestQuestions as $latest)
                                 <div class="aw-item article" data-topic-id="3,">
                                    <a class="aw-user-name hidden-xs" href="{{ URL::action('Front\HomeController@index', ['uid'=>$latest->user_id]) }}" rel="nofollow"><img src="{{ $latest->avator }}" alt="{{ $latest->author }}"></a>
                                    <div class="aw-question-content">
                                       <h4><a href="{{ URL::action('Front\QuestionController@detail', ['id'=>$latest->question_id]) }}">{{ $latest->title }}</a></h4>
                                       <p>
                                          <a class="aw-question-tags" href="{{ URL::action('Front\QuestionController@cate', ['cid'=>$latest->cate_id]) }}">{{ $latest->cate_name  }}</a>
                                          <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$latest->user_id]) }}" class="aw-user-name">{{ $latest->author }}</a> <span class="text-color-999">发布 • {{ $latest->comments }}个评论 • {{ $latest->views }} 次浏览 • {{\Carbon\Carbon::parse($latest->created_at)->diffForHumans()}}</span>
                                       </p>
                                    </div>
                                 </div>
                              @endforeach()
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end 最新问答 -->

                  <div class="aw-mod new-topic">
                     <div class="mod-head">
                        <a href="{{ url('/question/hotCate') }}" class="pull-right">更多 &gt;</a>
                        <h3>热门问答</h3>
                     </div>
                     <div class="mod-body clearfix">
                        <div class="aw-topic-bar">
                           <div class="aw-common-list">
                              @foreach( $hotQuestions as $hot)
                                 <div class="aw-item article" data-topic-id="3,">
                                    <a class="aw-user-name hidden-xs" href="{{ URL::action('Front\HomeController@index', ['uid'=>$hot->user_id]) }}" rel="nofollow"><img src="{{ $hot->avator }}" alt="{{ $hot->author }}"></a>
                                    <div class="aw-question-content">
                                       <h4><a href="{{ URL::action('Front\QuestionController@detail', ['id'=>$hot->question_id]) }}">{{ $hot->title }}</a></h4>
                                       <p>
                                          <a class="aw-question-tags" href="{{ URL::action('Front\QuestionController@cate', ['cid'=>$hot->cate_id]) }}">{{ $hot->cate_name  }}</a>
                                          <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$hot->user_id]) }}" class="aw-user-name">{{ $hot->author }}</a> <span class="text-color-999">发布 • {{ $hot->comments }}个评论 • {{ $hot->views }} 次浏览 • {{\Carbon\Carbon::parse($hot->created_at)->diffForHumans()}}</span>
                                       </p>
                                    </div>
                                 </div>
                              @endforeach()
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="aw-mod new-topic">
                     <div class="mod-head">
                        <a href="{{ url('/question/remainCate')  }}" class="pull-right">更多 &gt;</a>
                        <h3>待回答</h3>
                     </div>
                     <div class="mod-body clearfix">
                        <div class="aw-topic-bar">
                           <div class="aw-common-list">
                              @foreach( $remainQuestions as $remain)
                                 <div class="aw-item article" data-topic-id="3,">
                                    <a class="aw-user-name hidden-xs" href="{{ URL::action('Front\HomeController@index', ['uid'=>$remain->user_id]) }}" rel="nofollow"><img src="{{ $remain->avator }}" alt="{{ $remain->author }}"></a>
                                    <div class="aw-question-content">
                                       <h4><a href="{{ URL::action('Front\QuestionController@detail', ['id'=>$remain->question_id]) }}">{{ $remain->title }}</a></h4>
                                       <p>
                                          <a class="aw-question-tags" href="{{ URL::action('Front\QuestionController@cate', ['cid'=>$remain->cate_id]) }}">{{ $remain->cate_name  }}</a>
                                          <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$remain->user_id]) }}" class="aw-user-name">{{ $remain->author }}</a> <span class="text-color-999">发布 • {{ $remain->comments }}个评论 • {{ $remain->views }} 次浏览 • {{\Carbon\Carbon::parse($remain->created_at)->diffForHumans()}}</span>
                                       </p>
                                    </div>
                                 </div>
                              @endforeach()
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end 问答 -->

               <!-- 资源 -->
               <div class="col-sm-12 col-md-4 aw-side-bar ">
                  <!-- 最新资源 -->
                  <div class="aw-mod new-topic">
                     <div class="mod-head">
                        <a href="{{ url('/torrent') }}" class="pull-right">更多 &gt;</a>
                        <h3>最新资源</h3>
                     </div>
                     <div class="mod-body clearfix">
                        <div class="aw-topic-bar">
                           <div class="aw-common-list">
                              @foreach( $btDatas as $data)
                                 <div class="aw-item article" style="min-height: 68px;padding:4px 0px;" >
                                    <div class="aw-question-content">
                                       <h4><a href="{{ URL::action('Front\TorrentController@detail', ['id'=>$data->id]) }}">{{ $data->name }}</a></h4>
                                       <p>
                                          <a style="color:green;" href="magnet:?xt=urn:btih:{{ $data->info_hash }}">[磁力链接] </a><span class="text-color-999">文件大小：2.3 GB　 • 创建时间：{{ substr($data->create_time,0,10) }}　 • 热度：{{ $data->requests }} 次下载</span>
                                       </p>
                                    </div>
                                 </div>
                              @endforeach()
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end 最新资源 -->
                  <div class="aw-mod  new-topic">
                     <div class="mod-head">
                        <a href="{{ url('/torrent') }}" class="pull-right">更多 &gt;</a>
                        <h3>热门资源</h3>
                     </div>
                     <div class="mod-body ">
                        <div class="aw-topic-bar">
                           <div class="aw-common-list">
                              @foreach( $hotDatas as $data)
                                 <div class="aw-item article" style="min-height: 68px;padding:4px 0px;" >
                                    <div class="aw-question-content">
                                       <h4><a href="{{ URL::action('Front\TorrentController@detail', ['id'=>$data->id]) }}">{{ $data->name }}</a></h4>
                                       <p>
                                          <a style="color:green;" href="magnet:?xt=urn:btih:{{ $data->info_hash }}">[磁力链接] </a><span class="text-color-999">文件大小：2.3 GB　 • 创建时间：{{ substr($data->create_time,0,10) }}　 • 热度：{{ $data->requests }} 次下载</span>
                                       </p>
                                    </div>
                                 </div>
                              @endforeach()
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end 侧边栏 -->
            </div>
         </div>
      </div>
   </div>
@endsection
