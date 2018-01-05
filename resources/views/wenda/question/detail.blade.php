@extends('layouts.wenda')
@section('content')
<link href="{{ asset('wenda/layer/theme/default/layer.css') }}" rel="stylesheet">
<style>
/* 编辑器图片超出限制 */
img{
max-width:100%
}  
.main-content .wrapper .panel .panel-body span{
	display:inline-block;
	margin:0px 16px;
}
.category .nav_tabs .size{
	font-size:12px;
}
.bl-status{
	font-size:12px;
}
img{
	font-size:34px;
	line-height:32px;
	text-align:center;
}
</style>
<!-- 搜素内容 -->
<?php 
use App\Models\Common\UserModel;
?>
<div class="main-content" >
  <div class="wrapper">
      <div class="directory-info-row">
      	  <div class="col-md-2">
      	  
      	  </div>
          <div class="col-md-8 col-sm-8" >
               <div class="blog">
                  <div class="single-blog">
                      <div class="panel">
                          <div class="panel-body">
                              <div class="text-center">{{ $datas->title }}</div>
                               <p class="text-left auth-row">
                                	分类:<span><a href="{{ URL::action('Front\QuestionController@cate', ['cid'=>$datas->cateid]) }}">{{ $datas->catename }}</a></span>
                                	作者:<span><a href="{{ URL::action('Front\HomeController@index', ['uid'=>$datas->user_id]) }}">{{ $datas->author }}</a></span>
                                	<span>时间:</span>{{\Carbon\Carbon::parse($datas->created_at)->diffForHumans()}}
                                	<span>{{ $datas->countcomment }} 评论</span>
                                	@if($datas->user_id == Auth::id())
                                	<a class="detail"  href="{{ URL::action('Front\PostController@edit', ['id'=>$datas->question_id]) }}" >编辑</a>
                                	@endif
                               </p>
                               {!! $datas->content !!}
                              <div class="blog-tags">
                                  <span>标签</span>
                                  @foreach($tagss as $tag )
                                  <a target="_blank" href="{{ URL::action('Front\QuestionController@tag', ['tid'=>$tag->id]) }}">{{ $tag->name }}</a>
                                  @endforeach
                                  <div class="pull-right" id="scroll">
                                      <a href="#" class="btn btn-danger">分享</a>
                                      <a href="#" class="btn btn-success">点赞</a>
                                      @if($isCollected)
                                      	<a href="#" href="javascript:void(0);" onClick="collectCancel({{ $datas->question_id }});" class="btn">取消收藏</a>
                                      @else
                                      	<a href="#" href="javascript:void(0);" onClick="collect({{ $datas->question_id }});" class="btn">收藏</a>
                                      @endif
                                  </div>
                              </div>
                          </div>
                      </div>
        
			           <div class="panel">
							<div class="panel-body">
				                <h1 class="text-center cmnt-head">{{ $datas->countcomment }}<span>条评论</span></h1>
				                 <section class="mail-list">
				                	@foreach($answers as $answer)
					                	<div class="container-fluid" style="border-bottom:1px solid #D1D5E1;margin:12px 0px;">
											<div class="row-fluid" >
												<div class="span12" >
													<div class="media" style="margin-bottom: 12px;">
														<a target="_blank" href="{{ URL::action('Front\HomeController@index', ['uid'=>$answer->user_id]) }}" class="pull-left">
															<img src="{{ route('getThumbImg', $answer->user_id ) }}" class="pull-left media-object">
														</a>
														<div class="media-body">
															<div style="line-height:10px;margin-bottom:8px;">
																<span style="font-size: 14px;">
																	<a target="_blank" href=""></a>
																</span>
																<span style="margin-left:24px;font-size:12px;"></span>
															</div>
															<h6 class="media-heading" style="font-size:10px;">{{ $answer->content }}</h6>
														</div>
													</div>
												</div>
											</div>
										</div>
					                @endforeach()
					            </section>
				            </div>
			            	<div class="paginate" style="text-align:center;">{!! $answers->appends(array('id'=>$id))->render() !!}</div>
			          </div>
<!-- 	                  评论     -->
                       <div class="panel">
                          <div class="panel-body">
                                 <form class="form-horizontal" method="post" action="{{ url('/question/answer') }}" id="Form">
			                        	{{ csrf_field() }}
			                        	<div class="form-group" hidden>
			                                <div class="col-lg-6">
			                                    <input type="text" class="form-control" name="user_id" value="{{ Auth::id() }}" >
			                                </div>
			                            </div>
			                            <div class="form-group" hidden>
			                                <div class="col-lg-6">
			                                    <input type="text" class="form-control" name="question_id" value="{{ $datas->question_id }}" >
			                                </div> 
			                            </div>
			                            <div class="form-group">
			                                <div class="col-lg-12">
			                                	<textarea rows="4" class="form-control" name="answer" id=answer placeholder="我要回答"></textarea>
			                                </div>
			                            </div>
			                            <div class="form-group">
			                                <div class="col-lg-offset-10 col-lg-6">
			                                    <button type="submit" class="btn btn-primary">提交评论</button>
			                                </div>
			                            </div>
			                    </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-2 col-sm-2">
           	 @component('wenda.slot.myquestionslot')
             @endcomponent
            @component('wenda.slot.noticeslot')@endcomponent 
          </div>
      </div>
  </div>
</div>
@section('js')
@parent
<script type="text/javascript" src="{{ asset('wenda/layer/layer.js') }}" ></script>
<script>
// 文章收藏
function collect(id){
	$.post("{{ url('/question/collect') }}",
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
						location.href="{{ url('/login') }}";
					}else{
						layer.msg(data.msg);
						location.reload() ;
						}
					}
			});
}
//文章收藏
function collectCancel(id){
	$.post("{{ url('/question/collectCancel') }}",
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
	$("#answer").attr("placeholder","回复"+$userName);
	 var myform=$('#Form'); //得到form对象
     var tmpInput=$("<input type='hidden' name='to_user_id' />");
     tmpInput.attr("value", $userId);
     myform.append(tmpInput);
}
</script>
@stop
@endsection
