@extends('layouts.wenda')
@section('content')
<style>
.mail-list{
	height:auto;
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
                            <a href="{{ URL::action('Front\CategoryController@article', ['cateid'=>$cateid]) }}"><button class="btn btn-sm btn-default">文章</button></a>
                            <a href="{{ URL::action('Front\CategoryController@answer', ['cateid'=>$cateid]) }}"><button class="btn btn-sm btn-success">问答</button></a>
                        </div>
                        <div class="btn-toolbar">
                            <h4 class="pull-right"></h4>
                        </div>
                    </header>
	                <section class="mail-list">
	                @foreach($questions as $question)
	                	<div class="container-fluid" style="border-bottom:1px solid #D1D5E1;margin:12px 0px;">
							<div class="row-fluid" >
								<div class="span12" >
									<div class="media" style="margin-bottom: 12px;">
										<a href="#" class="pull-left"><img style="width:48px;" src="{{ route('getThumbImg', $question->user_id) }}" class="media-object" alt='' /></a>
										<div class="media-body">
											<div><span style="font-size: 14px;"><a href="">{{ $question->user_name }}</a></span><span style="margin-left:24px;font-size:12px;">{{ $question->created_at }}</span></div>
											<h6 class="media-heading" style="font-size:10px;"><a  href="{{ URL::action('Front\QuestionController@detail', ['id'=>$question->question_id]) }}">{{ $question->title }}</a></h6>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach() 
                    </section>
                    <div class="paginate" style="text-align:center;">{{ $questions->links() }}</div>
                </section>
          	
          </div>
          <div class="col-md-2 col-sm-2" >
             @component('wenda.slot.myquestionslot')
             @endcomponent
             @component('wenda.slot.tagslot')
             @endcomponent
          </div>
      </div>
  </div>
  <!--body wrapper end-->
</div>
<!-- main content end-->

@endsection
