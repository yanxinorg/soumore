@extends('layouts.ask')
@section('content')
<link href="{{ asset('ask/chosen/chosen.css') }}" rel="stylesheet">
<style>
    .chosen-container-single .chosen-single {
        position: relative;
        display: block;
        overflow: hidden;
        padding: 4px 4px 4px 8px;
        height: 34px;
        border: 1px solid #aaa;
        border-radius: 3px;
        background-color: #fff;
        background: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(20%, #ffffff), color-stop(50%, #f6f6f6), color-stop(52%, #ffffff), color-stop(100%, #ffffff));
        background: -webkit-linear-gradient(top, #ffffff 20%, #ffffff 50%, #ffffff 52%, #ffffff 100%);

        background: -moz-linear-gradient(top, #ffffff 20%, #ffffff 50%, #eeeeee 52%, #ffffff 100%);
        background: -o-linear-gradient(top, #ffffff 20%, #ffffff 50%, #eeeeee 52%, #ffffff 100%);
        background: linear-gradient(top, #ffffff 20%, #ffffff 50%, #eeeeee 52%, #ffffff 100%);
        background-clip: padding-box;
        /* box-shadow: 0 0 3px white inset, 0 1px 1px rgba(0, 0, 0, 0.1); */
        /* color: #444; */
        text-decoration: none;
        white-space: nowrap;
        line-height: 24px;
    }
</style>
	<div class="aw-container-wrap">
		<div class="container">
			<div class="row">
				<div class="aw-content-wrap clearfix">
					<div class="col-sm-12 col-md-9 aw-main-content">
                            <div class="mod-head common-head">
                                <h2><a href="{{ url('/person/letter') }}"  class="pull-right btn btn-mini btn-success">私信列表</a>
                                    <span class="pull-right aw-setting-inbox hidden-xs"></span>写私信<span style="font-size: 12px;">(只能发送自己关注的人)</span>
                                </h2>
                            </div>
								<div class="panel">
									<div class="panel-body">
										<form class="form-horizontal" method="post" action="{{ url('/person/storeLetter') }}" >
											@if ($errors->has('error'))
												<div class="form-group">
													<div class="col-md-12 col-sm-12">
														<div class="alert alert-error ">
															{{ $errors->first('error') }}
														</div>
													</div>
												</div>
											@endif
											{{ csrf_field() }}
											<div class="form-group" hidden>
												<input name="from_user_id" value="{{ Auth::id() }}" class="form-control" >
											</div>
											<div class="form-group">
												<div class="col-md-4">
                                                    <select  class="chosen-select form-control"  name="to_user_id" title="请选择用户...">
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach()
                                                    </select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-lg-12">
													<textarea rows="4" class="form-control" name="content" placeholder="私信内容"></textarea>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-offset-10 col-md-2">
													<button type="submit" class="btn btn-primary">立即发送</button>
												</div>
											</div>
										</form>
									</div>
								</div>
					</div>
					<!-- 侧边栏 -->
					<div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm">

						<div class="aw-mod side-nav">
							<div class="mod-body">
								<ul>
									<li><a href="{{ url('/dynamic') }}" ><i class="icon icon-home"></i>最新动态</a></li>
									<li><a href="{{ URL::action('Front\PersonController@post') }}" ><i class="icon icon-home"></i>我的文章</a></li>
									<li><a href="{{ url('/person/answer') }}" ><i class="icon icon-home"></i>我的问答</a></li>
									<li><a href="{{ url('/person/video') }}"><i class="icon icon-draft"></i>我的视频</a></li>
									<li><a href="{{ url('/person/postCollect') }}"><i class="icon icon-favor"></i>我的收藏</a></li>
									<li><a href="{{ url('/person/topicAttention') }}" rel="focus_topic__focus"><i class="icon icon-mytopic"></i>我的话题</a></li>
								</ul>
							</div>
						</div>

						<div class="aw-mod side-nav">
							<div class="mod-body">
								<ul>
									<li><a href="{{ url('/topic') }}"><i class="icon icon-topic"></i>所有话题</a></li>
									<li><a href="{{ url('/user/hot') }}"><i class="icon icon-user"></i>所有用户</a></li>
								</ul>
							</div>
						</div>

					</div>
					<!-- end 侧边栏 -->
				</div>
			</div>
		</div>
	</div>
@section('js')
@parent
<script src="{{ asset('ask/chosen/chosen.jquery.js') }}"></script>
<script type="text/javascript">
    jQuery(function(){
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'未找到该标签'},
            '.chosen-select-width'     : {width:"100%"}
        };
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
    });
</script>
@stop
@endsection