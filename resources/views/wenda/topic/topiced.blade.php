@extends('layouts.wenda')
@section('content')
<style>
.nav_tabs{
	background-color:white;
	font-size: 16px;
	text-align:center;
	padding:4px 0px;
}
.main-content .wrapper .directory-info-row .nav li.active{
	background-color:#EEEEEE;
}
</style>
<div class="main-content" >
  <div class="wrapper">
     <div class="directory-info-row">
	      <div class="col-md-2 col-sm-2" >
			<div class="col-md-12 col-sm-12" >
				<ul class="nav nav_tabs " >
					<li><a href="{{ URL::action('Front\TopicController@hot') }}">热门关注</a></li>
					<li class="active"><a href="{{ URL::action('Front\PersonController@topiced', ['uid'=>Auth::id()]) }}">已关注</a></li>
				</ul>
			</div>
		  </div>
        <div class="col-md-10 col-sm-10">
          <!--body wrapper start-->
              <ul class="directory-list">
                  @foreach($tags as $tag)
                          <div class="panel" style="width:282px;float:left;margin:12px;margin-top:0px;">
                              <div class="panel-body">
                                   <div class="pull-left">
                                       <img style="width:96px;" class="thumb" src="{{ route('getTopicImg', $tag->id) }}" alt=""/>
                                   </div>
                                   <div class="media-body">
                                      <div style="font-size:12px;">{{ $tag->name }}</div>
                                      <div style="font-size:12px;">{{ $tag->desc }}</div>
                                   </div>
                              </div>
                              <div class="panel-footer custom-trq-footer">
                              	  <a class="btn btn-success " href="{{ URL::action('Front\PersonController@topicCancel', ['tid'=>$tag->id]) }}">取消关注</a>
                              </div>
                          </div>
                  @endforeach()
                  <div class="paginate" style="text-align:center;">{{ $tags->links() }}</div>
              </ul>
          <!--body wrapper end-->
          </div>
      </div>
  </div>
  <!--body wrapper end-->
</div>
<!-- main content end-->
@endsection
