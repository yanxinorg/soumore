@extends('layouts.wenda')
@section('content')
<style>
.blog-img-sm{
	text-align: center;
}
.panel .panel-body .title{
	color:#0000CC;
	display:inline-block;
	line-height:1.4;
}
.panel .panel-body .auth-row{
	font-size: 12px;
	margin-bottom:4px;
}
.panel .panel-body .auth-row span{
	display:inline-block;
	margin:0px 8px;
}

.panel .panel-body .detail{
	font-size: 12px;
	color:#1ABC9C;
	float:right;
}
</style>
<div class="main-content" >
  <div class="wrapper">
      <div class="directory-info-row">
        <div class="col-md-2 col-sm-2" >
             @component('wenda.slot.cateslot')
             
             @endcomponent
             @component('wenda.slot.tagslot')
             
             @endcomponent
        </div>
          <div class="col-md-8 col-sm-8">
      			<section class="panel">
                        <header class="panel-heading custom-tab tab-right ">
                            <ul class="nav nav-tabs pull-left">
                            	<li class="">
                                    <a href="{{ URL::action('Front\CategoryController@lists', ['id'=>$id]) }}"><i class="fa fa-envelope-o"></i>默认</a>
                                </li>
                                <li class="active">
                                    <a href="{{ URL::action('Front\PostController@catelist', ['id'=>$id]) }}"><i class="fa fa-home"></i>文章</a>
                                </li>
                                <li class="">
                                    <a href="#about-3" data-toggle="tab"><i class="fa fa-user"></i>问答</a>
                                </li>
                            </ul>
                        </header>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane active">
	                                  @foreach($datas as $data)
				          				@if($data->thumb)
				          				 <div class="panel" >
                        					<div class="panel-body">
					                            <div class="row" >
					                                <div class="col-md-2 col-sm-2">
													    <div class="blog-img-sm"> 
					                                        <img src="{{ route('getPostImg', $data->post_id) }}" alt="头图">
					                                    </div>
					                                </div>
					                                <div class="col-md-10 col-sm-10">
					                                    <a class="title" target="_blank;" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ str_limit($data->title,170) }}</a>
					                                    <div class="auth-row" >
					                                        <span>作者: </span><a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}">{{ $data->author }}</a>
					                                        <span>时间:</span>{{ $data->created_at }}
					                                        <span><a href="#">{{ $data->comments }}</a></span>评论
					                                    </div>
					                                    <div class="excerpt" >{{ str_limit($data->excerpt,316) }}</div>
					                                    <a class="detail" target="_blank;" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}" class="article_detail.html">阅读全文</a>
					                                </div>
					                            </div>
				                        	</div>
				                        </div>
						          		@else
						          		<div class="panel" >
                        					<div class="panel-body">
					                            <div class="row">
					                                <div class="col-md-12 col-sm-12">
					                                    <a class="title" target="_blank;" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ str_limit($data->title,214) }}</a>
					                                    <div class="auth-row" >
					                                        <span>作者: </span><a href="#">{{ $data->author }}</a>
					                                        <span>时间:</span>{{ $data->created_at }}
					                                        <span><a href="#">{{ $data->comments }}</a></span>评论
					                                    </div>
					                                    <div class="excerpt">{{ str_limit($data->excerpt,316) }}</div>
					                                    <a class="detail" target="_blank;" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}" class="article_detail.html">阅读全文</a>
					                                </div>
					                            </div>
				                            </div>
				                         </div>
						          		@endif
	           						 @endforeach()
	           						 <div class="paginate" style="text-align:center;">{!! $datas->appends(array('id'=>$id))->render() !!}</div>
                                </div>
                            </div>
                        </div>
                    </section>
          </div>
        
          <div class="col-md-2 col-sm-2" >
            @component('wenda.slot.mycenterslot')
             
            @endcomponent
            @component('wenda.slot.noticeslot')
             
            @endcomponent 
          </div>
      </div>
  </div>
  <!--body wrapper end-->
</div>
<!-- main content end-->

@endsection
