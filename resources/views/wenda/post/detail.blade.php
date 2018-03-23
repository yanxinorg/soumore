@extends('layouts.wenda')
@section('content')
<link href="{{ asset('wenda/layer/theme/default/layer.css') }}" rel="stylesheet">
<style>
/* 编辑器图片超出限制 */
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
.blog-content img {
	max-width:100%;
}
</style>
<!-- 搜素内容 -->
<?php 
use App\Models\Common\UserModel;
?>
<div class="main-content" >
  <div class="wrapper">
      <div class="directory-info-row">
      		<div class="col-md-2 col-sm-3" >
				 @component('wenda.slot.noticeslot')@endcomponent 
           </div>
           
          <div class="col-md-8 col-sm-6" >
               <div class="blog">
                  <div class="single-blog">
                      <div class="panel">
                          <div class="panel-body">
                              <div class="text-center">{{ $datas->title }}</div>
                               <p class="text-left auth-row">
                                	分类:<span>
                                		<a target="_blank" href="{{ URL::action('Front\PostController@cate', ['cid'=>$datas->cateid]) }}">{{ $datas->catename }}</a>
                                	</span>
                                	作者:<span><a href="{{ URL::action('Front\HomeController@index', ['uid'=>$datas->user_id]) }}">{{ $datas->author }}</a></span>
                                	<span>时间:</span>{{\Carbon\Carbon::parse($datas->created_at)->diffForHumans()}}
                                	<span>{{ $datas->countcomment }} 评论</span>
                               </p>
                              <div class="blog-content">{!! $datas->content !!}</div>
                              <div class="blog-tags">
                              	@if(!empty($tagss[0]))
                                  <span>标签</span>
                                  @foreach($tagss as $tag )
                                  	<a target="_blank" class="label label-danger" href="{{ URL::action('Front\PostController@tag', ['tid'=>$tag->id]) }}">{{ $tag->name }}</a>
                                  @endforeach
                                @endif()
                                  <div class="pull-right" id="scroll">
                                      <a href="#" class="btn btn-danger">分享</a>
                                      <a href="#" class="btn btn-success">点赞</a>
                                      @if($isCollected)
                                      	<a href="#" href="javascript:void(0);" onClick="collectCancel({{ $datas->post_id }});" class="btn">取消收藏</a>
                                      @else
                                      	<a href="#" href="javascript:void(0);" onClick="collect({{ $datas->post_id }});" class="btn">收藏</a>
                                      @endif
                                  </div>
                              </div>
                          </div>
                      </div>
        
			           <div class="panel">
				            <div class="panel-body">
				                <h1 class="text-center cmnt-head">{{ $datas->countcomment }}<span>条评论</span></h1>
				                	@foreach($comments as $comment)
					                <div class="media blog-cmnt">
					                    <img src="{{ route('getThumbImg', $comment->user_id ) }}" class="pull-left media-object">
					                    <div class="media-body">
					                        <div style="font-size:14px;">
					                             <a class="pull-left" href="{{ URL::action('Front\HomeController@index', ['uid'=>$comment->user_id]) }}">{{ $comment->commentator }}</a>
					                             @if(!empty($comment->to_user_id))
					                        	 	 <span class="pull-left">回复</span>
						                        	 <a class="pull-left" href="{{ URL::action('Front\HomeController@index', ['uid'=>$comment->to_user_id]) }}">
						                        	 @php echo (UserModel::where('id',$comment->to_user_id)->pluck('name'))[0]; @endphp
						                        	 </a>
					                        	 @endif
					                        	 <span class="pull-left">{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
					                        	 @if($comment->user_id !== Auth::id() )
					                        	 	<a href="javascript:void(0);" onclick="reply({{ $comment->user_id }},'{{ $comment->commentator }}')" class="pull-right ">回复</a>
					                        	 @endif
					                        </div>
					                        <div class="bl-status">
					                          {{ $comment->content }}
					                        </div>
					                    </div>
					                </div>
					                @endforeach()
				            </div>
			            <div class="paginate" style="text-align:center;">{!! $comments->appends(array('id'=>$id))->render() !!}</div>
			          </div>
<!-- 提交 评论     -->
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
			                                	<textarea rows="4" class="form-control" name="comment" id="comment" placeholder="说出你的故事"></textarea>
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
              </div>
          </div>
          <div class="col-md-2 col-sm-3">
           	@component('wenda.slot.mycenterslot')@endcomponent
           
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
//文章收藏
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
