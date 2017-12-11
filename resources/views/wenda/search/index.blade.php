@extends('layouts.wenda')
@section('content')
<style>
.mail-list{
	height:600px;
}
.pricing-table{
	box-shadow:none;
}
</style>
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
							<a href="{{ URL::action('Front\SearchController@wenda', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">问答</button></a>
							<a href="{{ URL::action('Front\SearchController@topic', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">话题</button></a>
							<a href="{{ URL::action('Front\SearchController@user', ['wd'=>$wd]) }}"><button class="btn btn-default btn-sm">用户</button></a>
                        </div>
                        <div class="btn-toolbar">
                            <h4 class="pull-right"></h4>
                        </div>
                    </header>
	                <section class="mail-list">
	               			<div class="wrapper">
					            <div class="row">
					                <div class="col-sm-12">
					                    <!--price start-->
					                    <div class="text-center price-head">
					                        <h1 class="color-terques" >搜索结果</h1>
					                    </div>
					                    <div class="col-lg-3 col-sm-3">
					                        <div class="pricing-table">
					                            <div class="pricing-head">
					                                <h1>文章</h1>
					                                 {{ $postCount }}
					                                 <span class="note">篇</span>
					                            </div>
					                            <div class="price-actions">
					                                <a target="_blank" href="{{ URL::action('Front\SearchController@post', ['wd'=>$wd]) }}" class="btn">查看</a>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="col-lg-3 col-sm-3">
					                        <div class="pricing-table">
					                            <div class="pricing-head">
					                                <h1>问答</h1>
					                                 {{ $questionCount }}
					                                 <span class="note">篇</span>
					                            </div>
					                            
					                            <div class="price-actions">
					                                <a target="_blank" href="{{ URL::action('Front\SearchController@wenda', ['wd'=>$wd]) }}" class="btn">查看</a>
					                            </div>
					                        </div>
					                    </div>
					                     <div class="col-lg-3 col-sm-3">
					                        <div class="pricing-table">
					                            <div class="pricing-head">
					                                <h1>话题</h1>
					                                 {{ $tagCount }}
					                                 <span class="note">个</span>
					                            </div>
					                            <div class="price-actions">
					                                <a target="_blank" href="{{ URL::action('Front\SearchController@topic', ['wd'=>$wd]) }}" class="btn">查看</a>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="col-lg-3 col-sm-3">
					                        <div class="pricing-table ">
					                            <div class="pricing-head">
					                                <h1>用户</h1>
					                                 {{ $userCount }}
					                                 <span class="note">位</span>
					                            </div>
					                            <div class="price-actions">
					                                <a target="_blank" href="{{ URL::action('Front\SearchController@user', ['wd'=>$wd]) }}" class="btn">查看</a>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					            </div>

        				</div>
                    </section>
                </section>
          </div>
          <div class="col-md-2 col-sm-2" >
            
          </div>
      </div>
  </div>
  <!--body wrapper end-->
</div>
@section('js')
@parent
<script type="text/javascript">
//tag初始化
jQuery(function(){
	$(".pricing-table").hover(function(){
		$(this).addClass("most-popular");
		});
	$(".pricing-table").mouseleave(function(){
		$(this).removeClass("most-popular");
		});
});
</script>
@stop
@endsection
