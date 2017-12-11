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
.container-fluid{
	border-bottom:1px solid #D1D5E1;
	margin:12px 0px;
}
.container-fluid .row-fluid .media{
	margin-bottom: 12px;
}
.container-fluid .row-fluid .media img{
	width:96px;
}
.container-fluid .row-fluid .media-body .content{
	display:block;
	font-size: 14px;
}
.container-fluid .row-fluid .media-body .content h6{
	font-size:14px;
	display:inline-block;
	margin-left:80px;
}
.container-fluid .row-fluid .media-body .content span{
	 margin-left:24px;
}
.container-fluid .row-fluid .media-body .excerpt{
	font-size:12px;
	margin-left:24px;
	margin-top:6px;
}
</style>
<?php 
use App\Models\Common\AttentionModel;
?>
<div class="main-content">
  <div class="wrapper">
      <div class="directory-info-row">
      <div class="col-md-2 col-sm-2" >
      		
      </div>
          <div class="col-md-8 col-sm-8">
                <section class="mail-box-info">
                    <header class="header">
                         <div class="compose-btn pull-left">
							<a href="{{ URL::action('Front\SearchController@post', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">文章</button></a>
							<a href="{{ URL::action('Front\SearchController@wenda', ['wd'=>$wd]) }}"><button class="btn btn-success btn-sm">问答</button></a>
							<a href="{{ URL::action('Front\SearchController@topic', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">话题</button></a>
							<a href="{{ URL::action('Front\SearchController@user', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">用户</button></a>
                        </div>
                        <div class="btn-toolbar">
                            <h4 class="pull-right"></h4>
                        </div>
                    </header>
	                <section class="mail-list">
                       	  <div class="directory-info-row">
			                  <div class="row">
			                  <div class="col-md-12 col-sm-12">
			                  @foreach($datas as $tag)
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
			                   {!! $datas->links() !!}
			                  </div>
			              </div>
                    </section>
                </section>
          	<div class="paginate" style="text-align:center;"></div>
          </div>
          <div class="col-md-2 col-sm-2" >
            
          </div>
      </div>
  </div>
  <!--body wrapper end-->
</div>
<!-- main content end-->

@endsection
