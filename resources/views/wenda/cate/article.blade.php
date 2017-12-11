@extends('layouts.wenda')
@section('content')
<style>
.mail-list{
	height:auto;
}
.blog-img-sm{
	text-align: center;
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
	font-size: 16px;
	color:#1ABC9C;
	float:right;
}
.nav_tabs{
	background-color:white;
}
.nav_tabs li:last-child{
	padding-bottom:12px;
}

</style>

<div class="main-content">
  <div class="wrapper">
      <div class="directory-info-row">
      <div class="col-md-2 col-sm-2" >
      		<div class="category">
					<div class="col-md-12 col-sm-12" >
						<ul class="nav nav_tabs " >
							<h6 style="text-align: center;">分类</h6>
							@foreach($cates as $cate)
							@if($cate->id == $cateid )
							<li style="font-size: 16px; text-align:center; background-color:#EEEEEE;margin:4px 0px;" >
								<a href="{{ URL::action('Front\CategoryController@index', ['cateid'=>$cate->id]) }}">{{ $cate->name }}</a>
							</li>
							@else
							<li style="font-size: 16px; text-align:center;margin:4px 0px;" >
								<a href="{{ URL::action('Front\CategoryController@index', ['cateid'=>$cate->id]) }}">{{ $cate->name }}</a>
							</li>
							@endif
							@endforeach()
						</ul>
				</div>
			</div>
      
      </div>
          <div class="col-md-8 col-sm-8">
                <section class="mail-box-info">
                    <header class="header">
                        <div class="compose-btn pull-left">
                            <a href="{{ URL::action('Front\CategoryController@index', ['cateid'=>$cateid]) }}"><button class="btn btn-default btn-sm">最新问答</button></a>
                            <a href="{{ URL::action('Front\CategoryController@article', ['cateid'=>$cateid]) }}"><button class="btn btn-sm btn-success">文章</button></a>
                            <a href="{{ URL::action('Front\CategoryController@answer', ['cateid'=>$cateid]) }}"><button class="btn btn-sm btn-default">问答</button></a>
                        </div>
                        <div class="btn-toolbar">
                            <h4 class="pull-right"></h4>
                        </div>
                    </header>
	                <section class="mail-list">
                       @foreach($datas as $data)
			          		@if($data->thumb)
			          			 <div class="panel" >
			                        <div class="panel-body">
			                            <div class="row" >
			                                <div class="col-md-2 col-sm-2">
											    <div class="blog-img-md"> 
			                                        <img src="{{ route('getPostImg', $data->post_id) }}" alt="头图">
			                                    </div>
			                                </div>
			                                <div class="col-md-10 col-sm-10">
			                                    <a class="title" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ str_limit($data->title,170) }}</a>
			                                    <div class="auth-row" >
			                                        <span>作者: </span><a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}">{{ $data->author }}</a>
			                                        <span>时间:</span>{{ $data->created_at }}
			                                        <span>{{ $data->countcomment }} 评论</span>
			                                    </div>
			                                    <div class="excerpt" >{{ str_limit($data->excerpt,316) }}</div>
			                                    <a class="detail"  href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}" >阅读全文</a>
			                                </div>
			                            </div>
			                        </div>
			                      </div>
			          		@else
			          			 <div class="panel">
			                        <div class="panel-body">
			                            <div class="row">
			                                <div class="col-md-12 col-sm-12">
			                                    <a class="title" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}">{{ str_limit($data->title,214) }}</a>
			                                    <div class="auth-row" >
			                                        <span>作者: </span><a href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->user_id]) }}">{{ $data->author }}</a>
			                                        <span>时间:</span>{{ $data->created_at }}
			                                        <span>{{ $data->countcomment }} 评论</span>
			                                    </div>
			                                    <div class="excerpt">{{ str_limit($data->excerpt,316) }}</div>
			                                    <a class="detail" href="{{ URL::action('Front\PostController@detail', ['id'=>$data->post_id]) }}" >阅读全文</a>
			                                </div>
			                            </div>
			                        </div>
			                      </div>
			          		@endif
			            @endforeach()
			          	<div class="paginate" style="text-align:center;">{{ $datas->links() }}</div>
                    </section>
                </section>
          	<div class="paginate" style="text-align:center;"></div>
          </div>
          <div class="col-md-2 col-sm-2" >
             @component('wenda.slot.mycenterslot')
             @endcomponent
          </div>
      </div>
  </div>
  <!--body wrapper end-->
</div>
<!-- main content end-->

@endsection
