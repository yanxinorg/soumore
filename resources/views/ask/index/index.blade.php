@extends('layouts.ask')
@section('content')
   <style>
      .aw-side-bar .aw-mod{
         padding: 10px 0px;
      }
      .aw-common-list .aw-item {
         position: relative;
         z-index: 0;
         min-height: 56px;
         padding: 7px 0 7px 50px;
      }
      .btn-block {
         display: block;
         width: 80%;
         margin:0 auto;
      }
      .aw-side-bar .aw-mod .mod-head {
         padding-bottom: 0px;
      }
      .alert {
         padding: 15px;
         margin-bottom: 20px;
         border: 1px solid transparent;
         border-radius: 4px;
      }
   </style>
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
               <div class="col-sm-12 col-md-5 aw-side-bar">
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
                                    <a class="aw-user-name" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" rel="nofollow"><img src="{{ $data->avator }}-sm_thumb_middle" /></a>
                                    <div class="aw-question-content">
                                       <h4><a href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ $data->title }}</a></h4>
                                       <p>
                                          <a class="aw-question-tags" href="{{ URL::action('Front\PostController@cate',['cid'=>$data->cate_id]) }}">{{ $data->cate_name }}</a>
                                          <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" class="aw-user-name">{{ $data->author }}</a> <span class="text-color-999">发布 • {{ $data->countcomment }} 个评论 • {{ $data->hits }} 次浏览 • {{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
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
                                    <a class="aw-user-name" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" rel="nofollow"><img src="{{ $data->avator }}-sm_thumb_middle" /></a>
                                    <div class="aw-question-content">
                                       <h4><a href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ $data->title }}</a></h4>
                                       <p>
                                          <a class="aw-question-tags" href="{{ URL::action('Front\PostController@cate',['cid'=>$data->cate_id]) }}">{{ $data->cate_name }}</a>
                                          <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}" class="aw-user-name">{{ $data->author }}</a> <span class="text-color-999">发布 • {{ $data->countcomment }} 个评论 • {{ $data->hits }} 次浏览 • {{\Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
                                       </p>
                                    </div>
                                 </div>
                              @endforeach()
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end 文章 -->

               <!-- 问答 -->
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
                                    <a class="aw-user-name" href="{{ URL::action('Front\HomeController@index', ['uid'=>$latest->user_id]) }}" rel="nofollow"><img src="{{ $latest->avator }}" alt="{{ $latest->author }}"></a>
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
                                    <a class="aw-user-name" href="{{ URL::action('Front\HomeController@index', ['uid'=>$hot->user_id]) }}" rel="nofollow"><img src="{{ $hot->avator }}" alt="{{ $hot->author }}"></a>
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

               </div>
               <!-- end 问答 -->

               <!-- 侧边栏 -->
               <div class="col-sm-12 col-md-3 aw-side-bar ">
                  <div class="aw-mod aw-text-align-justify">
                     <div class="mod-head">
                        <h3 style="text-align: center;padding-bottom: 8px;color: red;font-size: 18px;">最新公告</h3>
                        <div class="side-alert alert " style="margin-bottom: 12px;background-color: #F4F4F4">
                           @if(!empty($notice))
                              {!! $notice->content !!}
                           @endif
                        </div>
                     </div>
                     <div class="mod-body">
                        <div class="side-alert alert alert-link">
                           <a href="{{ url('/post/create') }}" class="btn btn-primary btn-block">发布文章</a>
                           <a href="{{ url('/question/create') }}" class="btn btn-warning btn-block">我要提问</a>
                        </div>
                     </div>
                  </div>

                  {{--热门话题--}}
                  <div class="aw-mod aw-text-align-justify">
                     <div class="mod-head">
                        <a href="{{ url('/topic') }}" class="pull-right">更多 &gt;</a>
                        <h3>热门话题</h3>
                     </div>
                     <div class="mod-body">
                        @foreach($hotTags as $hottag)
                           <dl>
                              <dt class="pull-left aw-border-radius-5">
                                 <a href="{{ URL::action('Front\TopicController@detail', ['id'=>$hottag->id]) }}"><img alt="" src="{{ $hottag->thumb }}"></a>
                              </dt>
                              <dd class="pull-left">
                                 <p class="clearfix">
                                    <span class="topic-tag">
                                        <a href="{{ URL::action('Front\TopicController@detail', ['id'=>$hottag->id]) }}" class="text" data-id="2">{{ $hottag->name }}</a>
                                    </span>
                                 </p>
                                 <p><b>{{ $hottag->posts }}</b> 篇文章, <b>{{ $hottag->watchs }}</b> 人关注</p>
                              </dd>
                           </dl>
                        @endforeach()
                     </div>
                  </div>
                  {{--热门用户--}}
                  <div class="aw-mod aw-text-align-justify">
                     <div class="mod-head">
                        <a href="{{ url('/user/hot')  }}" class="pull-right">更多 &gt;</a>
                        <h3>热门用户</h3>
                     </div>
                     <div class="mod-body">
                        @foreach($hotUsers as $user)
                           <dl>
                              <dt class="pull-left aw-border-radius-5">
                                 <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$user->id]) }}"><img  src="{{ $user->avator }}-sm_thumb_small" onerror="this.src='{{ asset('ask/img/default_avator.jpg') }}'"></a>
                              </dt>
                              <dd class="pull-left">
                                 <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$user->id]) }}" data-id="2" class="aw-user-name">{{ $user->name  }}</a>
                                 <p class="signature"></p>
                                 <p ><a style="color: #999999;" href="{{ URL::action('Front\HomeController@post', ['uid'=>$user->id]) }}"><b>{{ $user->count_post }}</b></a> 篇文章, <a style="color: #999999;" href="{{ URL::action('Front\HomeController@question', ['uid'=>$user->id]) }}"><b>{{ $user->count_question }}</b></a> 个提问</p>
                              </dd>
                           </dl>
                        @endforeach()
                     </div>
                  </div>
               </div>
               <!-- end 侧边栏 -->
            </div>
         </div>
      </div>
   </div>
@endsection
