@extends('layouts.wenda')
@section('content')
<style>
.nav_tabs{
	background-color:white;
	font-size: 16px;
	text-align:center;
	padding:4px 0px;
}
</style>
<?php 
use App\Models\Common\AttentionModel;
?>
<div class="main-content" >
  <div class="wrapper">
     <div class="directory-info-row">
	      <div class="col-md-2 col-sm-2" >
				<div class="col-md-12 col-sm-12" >
					<ul class="nav nav_tabs " >
						<li><a href="{{ URL::action('Front\PersonController@topiced') }}">已关注</a></li>
					</ul>
			</div>
		  </div>
        <div class="col-md-10 col-sm-10">
          <!--body wrapper start-->
              <ul class="directory-list">
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'a']) }}">a</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'b']) }}">b</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'c']) }}">c</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'d']) }}">d</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'e']) }}">e</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'f']) }}">f</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'g']) }}">g</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'h']) }}">h</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'i']) }}">i</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'j']) }}">j</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'k']) }}">k</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'l']) }}">l</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'m']) }}">m</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'n']) }}">n</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'o']) }}">o</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'p']) }}">p</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'q']) }}">q</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'r']) }}">r</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'s']) }}">s</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'t']) }}">t</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'u']) }}">u</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'v']) }}">v</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'w']) }}">w</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'x']) }}">x</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'y']) }}">y</a></li>
                  <li><a href="{{ URL::action('Front\TopicController@abc', ['val'=>'z']) }}">z</a></li>
              </ul>
              <div class="directory-info-row">
                  <div class="row">
                  <div class="col-md-12 col-sm-12">
                  @foreach($tags as $tag)
                          <div class="panel" style="width:282px;float:left;margin:12px;">
                              <div class="panel-body">
                                   <div class="pull-left" >
                                          <img style="width:96px;" class="thumb" src="{{ route('getTagImg', $tag->id) }}" alt=""/>
                                   </div>
                                   <div class="media-body">
                                      <div style="font-size:12px;">{{ $tag->name }}</div>
                                      <div style="font-size:12px;">{{ $tag->desc }}</div>
                                   </div>
                              </div>
                              <div class="panel-footer custom-trq-footer">
                                @if( AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$tag->id,'source_type'=>'3'])->exists())
                               		<a class="btn btn-success " href="{{ URL::action('Front\PersonController@topicCancel', ['tid'=>$tag->id]) }}">取消关注</a>
		                        @else
		                            <a class="btn btn-default " href="{{ URL::action('Front\PersonController@topicCreate', ['tid'=>$tag->id]) }}">关注</a>
		                        @endif
                              </div>
                          </div>
                  @endforeach()
                   </div>
                   {!! $tags->links() !!}
                  </div>
              </div>
          <!--body wrapper end-->

          </div>
      </div>
  </div>
  <!--body wrapper end-->
</div>
<!-- main content end-->

@endsection
