@extends('layouts.ask')
@section('content')
<?php
use App\Models\Common\AttentionModel;
?>
	<div class="aw-container-wrap">
		<div class="container1">
			<div class="row">
				<div class="aw-content-wrap clearfix">
					<div class="col-sm-12 aw-main-content">
						<div class="aw-mod aw-mod-search-result">
							<div class="mod-head">
								<div class="tabbable">
									<ul class="nav nav-tabs aw-nav-tabs active" id="list_nav">
										<li  class="active"><a href="{{ URL::action('Front\SearchController@user', ['wd'=>$wd]) }}" >用户</a></li>
										<li><a href="{{ URL::action('Front\SearchController@topic', ['wd'=>$wd]) }}" >话题</a></li>
										<li><a href="{{ URL::action('Front\SearchController@wenda', ['wd'=>$wd]) }}" >问题</a></li>
										<li><a href="{{ URL::action('Front\SearchController@post', ['wd'=>$wd]) }}" >文章</a></li>
										<li ><a href="{{ URL::action('Front\SearchController@index', ['wd'=>$wd]) }}">全部</a></li>
										<h2 class="hidden-xs"><p>搜索 - <span id="aw-search-type">全部</span></p></h2>
									</ul>
								</div>
							</div>
							<div class="mod-body">
								<div class="tab-content">
									<div class="tab-pane active">
										<div class="aw-mod">
											<div class="mod-body aw-people-list">
												@foreach($datas as $user)
													<div class="aw-item">
														<a class="aw-user-img aw-border-radius-5" href="{{ URL::action('Front\HomeController@index', ['uid'=>$user->id]) }}">
															<img style="width:50px;" src="{{ $user->avator }}-sm_thumb_middle">
														</a>
														<p class="text-color-999 title">
															<a href="{{ URL::action('Front\HomeController@index', ['uid'=>$user->id]) }}" class="aw-user-name">{{ $user->name  }}</a>
														</p>
														<p class="text-color-999 signature"></p>
														<div class="meta">
															<span><i class="icon icon-prestige"></i>威望 <b>0</b></span>
															<span><i class="icon icon-agree"></i>赞同 <b>0</b></span>
															<span><i class="icon icon-thank"></i>感谢 <b>0</b></span>
														</div>

														{{--关注用户--}}
														@if(!empty(Auth::id()))
															{{--登录用户--}}
															@if( AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$user->id,'source_type'=>'1'])->exists())
																<div class="operate">
																	<a class="follow btn btn-normal btn-success active" href="{{ URL::action('Front\AttentionController@cancelUser', ['uid'=>$user->id]) }}">取消关注</a>
																</div>
															@else
																@if(Auth::id() !== $user->id )
																	<div class="operate">
																		<a class="follow btn btn-normal btn-success" href="{{ URL::action('Front\AttentionController@user', ['uid'=>$user->id]) }}">关注</a>
																	</div>
																@endif
															@endif
														@else
															{{--没有登录--}}
															<div class="operate">
																<a href="{{ URL::action('Front\AttentionController@user', ['uid'=>$user->id]) }}"  class="follow btn btn-normal btn-success"><span>关注</span></a>
															</div>
														@endif
													</div>
												@endforeach()
												<div class="paginate" style="text-align:center;">{!! $datas->appends(array('wd'=>$wd))->render() !!}</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
