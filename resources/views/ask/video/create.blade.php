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
	text-decoration: none;
	white-space: nowrap;
	line-height: 24px;
	}

	select > option{
		height:33px;
		line-height:24px;
	}
</style>
<style>
	.uploader{
		position:relative;
		display:inline-block;
		overflow:hidden;
		cursor:default;
		padding:0;
		margin:10px 0px;
		-moz-box-shadow:0px 0px 5px #ddd;
		-webkit-box-shadow:0px 0px 5px #ddd;
		box-shadow:0px 0px 5px #ddd;

		-moz-border-radius:5px;
		-webkit-border-radius:5px;
		border-radius:5px;
	}

	.filename{
		float:left;
		display:inline-block;
		outline:0 none;
		height:34px;
		margin:0;
		padding:8px 10px;
		overflow:hidden;
		cursor:default;
		border:1px solid;
		border-right:0;
		font:9pt/100% Arial, Helvetica, sans-serif; color:#777;
		text-shadow:1px 1px 0px #fff;
		text-overflow:ellipsis;
		white-space:nowrap;

		-moz-border-radius:5px 0px 0px 5px;
		-webkit-border-radius:5px 0px 0px 5px;
		border-radius:5px 0px 0px 5px;

		background:#f5f5f5;
		background:-moz-linear-gradient(top, #fafafa 0%, #eee 100%);
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#fafafa), color-stop(100%,#f5f5f5));
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fafafa', endColorstr='#f5f5f5',GradientType=0);
		border-color:#ccc;

		-moz-box-shadow:0px 0px 1px #fff inset;
		-webkit-box-shadow:0px 0px 1px #fff inset;
		box-shadow:0px 0px 1px #fff inset;

		-moz-box-sizing:border-box;
		-webkit-box-sizing:border-box;
		box-sizing:border-box;
	}

	.button{
		float:left;
		height:34px;
		display:inline-block;
		outline:0 none;
		padding:8px 12px;
		margin:0;
		cursor:pointer;
		border:1px solid;
		font:bold 9pt/100% Arial, Helvetica, sans-serif;

		-moz-border-radius:0px 5px 5px 0px;
		-webkit-border-radius:0px 5px 5px 0px;
		border-radius:0px 5px 5px 0px;

		-moz-box-shadow:0px 0px 1px #fff inset;
		-webkit-box-shadow:0px 0px 1px #fff inset;
		box-shadow:0px 0px 1px #fff inset;
	}


	.uploader input[type=file]{
		position:absolute;
		top:0; right:0; bottom:0;
		border:0;
		padding:0; margin:0;
		height:34px;
		cursor:pointer;
		filter:alpha(opacity=0);
		-moz-opacity:0;
		-khtml-opacity: 0;
		opacity:0;
	}

	input[type=button]::-moz-focus-inner{padding:0; border:0 none; -moz-box-sizing:content-box;}
	input[type=button]::-webkit-focus-inner{padding:0; border:0 none; -webkit-box-sizing:content-box;}
	input[type=text]::-moz-focus-inner{padding:0; border:0 none; -moz-box-sizing:content-box;}
	input[type=text]::-webkit-focus-inner{padding:0; border:0 none; -webkit-box-sizing:content-box;}

	/* White Color Scheme ------------------------ */

	.white .button{
		color:#555;
		text-shadow:1px 1px 0px #fff;
		background:#ddd;
		background:-moz-linear-gradient(top, #eeeeee 0%, #dddddd 100%);
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#dddddd));
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#eeeeee', endColorstr='#dddddd',GradientType=0);
		border-color:#ccc;
	}

	.white:hover .button{
		background:#eee;
		background:-moz-linear-gradient(top, #dddddd 0%, #eeeeee 100%);
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#dddddd), color-stop(100%,#eeeeee));
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dddddd', endColorstr='#eeeeee',GradientType=0);
	}

	/* Blue Color Scheme ------------------------ */

	.blue .button{
		color:#fff;
		text-shadow:1px 1px 0px #09365f;
		background:#064884;
		background:-moz-linear-gradient(top, #3b75b4 0%, #064884 100%);
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#3b75b4), color-stop(100%,#064884));
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3b75b4', endColorstr='#064884',GradientType=0);
		border-color:#09365f;
	}

	.blue:hover .button{
		background:#3b75b4;
		background:-moz-linear-gradient(top, #064884 0%, #3b75b4 100%);
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#064884), color-stop(100%,#3b75b4));
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#064884', endColorstr='#3b75b4',GradientType=0);
	}

	/* Green Color Scheme ------------------------ */

	.green .button{
		color:#fff;
		text-shadow:1px 1px 0px #6b7735;
		background:#7d8f33;
		background:-moz-linear-gradient(top, #93aa4c 0%, #7d8f33 100%);
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#93aa4c), color-stop(100%,#7d8f33));
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#93aa4c', endColorstr='#7d8f33',GradientType=0);
		border-color:#6b7735;
	}

	.green:hover .button{
		background:#93aa4c;
		background:-moz-linear-gradient(top, #7d8f33 0%, #93aa4c 100%);
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#7d8f33), color-stop(100%,#93aa4c));
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#7d8f33', endColorstr='#93aa4c',GradientType=0);
	}

	/* Red Color Scheme ------------------------ */

	.red .button{
		color:#fff;
		text-shadow:1px 1px 0px #7e0238;
		background:#90013f;
		background:-moz-linear-gradient(top, #b42364 0%, #90013f 100%);
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#b42364), color-stop(100%,#90013f));
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#b42364', endColorstr='#90013f',GradientType=0);
		border-color:#7e0238;
	}

	.red:hover .button{
		background:#b42364;
		background:-moz-linear-gradient(top, #90013f 0%, #b42364 100%);
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#90013f), color-stop(100%,#b42364));
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#90013f', endColorstr='#b42364',GradientType=0);
	}

	/* Orange Color Scheme ------------------------ */

	.orange .button{
		color:#fff;
		text-shadow:1px 1px 0px #c04501;
		background:#d54d01;
		background:-moz-linear-gradient(top, #f86c1f 0%, #d54d01 100%);
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#f86c1f), color-stop(100%,#d54d01));
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f86c1f', endColorstr='#d54d01',GradientType=0);
		border-color:#c04501;
	}

	.orange:hover .button{
		background:#f86c1f;
		background:-moz-linear-gradient(top, #d54d01 0%, #f86c1f 100%);
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#d54d01), color-stop(100%,#f86c1f));
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#d54d01', endColorstr='#f86c1f',GradientType=0);
	}

	/* Black Color Scheme ------------------------ */

	.black .button{
		color:#fff;
		text-shadow:1px 1px 0px #111111;
		background:#222222;
		background:-moz-linear-gradient(top, #444444 0%, #222222 100%);
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#444444), color-stop(100%,#222222));
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#444444', endColorstr='#222222',GradientType=0);
		border-color:#111111;
	}

	.black:hover .button{
		background:#444444;
		background:-moz-linear-gradient(top, #222222 0%, #444444 100%);
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#222222), color-stop(100%,#444444));
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#222222', endColorstr='#444444',GradientType=0);
	}
</style>
@include('UEditor::head')
	<div class="aw-container-wrap">
		<div class="container1 aw-publish aw-publish-article">
			<div class="row">
				<div class="aw-content-wrap clearfix">
					<div class="col-sm-12 col-md-9 aw-main-content">
						<!-- tab 切换 -->
						<ul class="nav nav-tabs aw-nav-tabs active">
							@role('administrators')
							<li><a href="{{ url('/video/create') }}">视频</a></li>
							@endrole
							<li ><a href="{{ url('/post/create') }}">文章</a></li>
							<li><a href="{{ url('/question/create') }}">问题</a></li>
							<h2 class="hidden-xs"><i class="icon icon-ask"></i> 发起</h2>
						</ul>
						<!-- end tab 切换 -->
						<form action="{{ url('/video/store') }}" method="post" enctype="multipart/form-data" onkeydown="if(event.keyCode==13)return false;">
                            {{ csrf_field() }}
							<div class="aw-mod aw-mod-publish">
								<div class="mod-body">
									<h3>视频标题：</h3>
									<div class="aw-publish-title">
                                        <!-- 视频标题 -->
										<input type="text" name="title"　value="{{ old('title') }}" class="form-control">
										{{--分类--}}
										<div class="dropdown " id="cate">
											<select data-placeholder="选择分类..." class="chosen-select form-control"   tabindex="4" name="cid">
												@foreach($cates as $cate)
													@if(!empty(old('cid')))
														@if($cate->id == old('cid'))
															<option  value="{{ $cate->id }}">{{ $cate->name }}</option>
														@else
															<option value="{{ $cate->id }}" >{{ $cate->name }}</option>
														@endif
													@else
														<option value="{{ $cate->id }}" >{{ $cate->name }}</option>
													@endif
												@endforeach()
											</select>
										</div>
									</div>
									@if ($errors->has('title'))
										<li class="alert alert-danger error_message" style="margin-top: 12px;">
											<i class="icon icon-delete"></i>
											<em>{{ $errors->first('title') }}</em>
										</li>
									@endif

                                    {{--缩略图上传--}}
                                    <h3>视频头图：</h3>
									<div class="row">
										<div class="col-md-12 col-sm-12" >
											<div class="uploader white" style="width: 100%;">
												<input type="text" class="filename" style="width: 80%;" readonly />
												<input type="button" style="width: 20%;" class="button" value="Browse..."/>
												<input type="file" name="thumb" accept="image/*" value="{{ old('local_video') }}" size="30" multiple/>
											</div>
										</div>
									</div>
									@if ($errors->has('thumb'))
										<li class="alert alert-danger error_message">
											<i class="icon icon-delete"></i>
											<em>{{ $errors->first('thumb') }}</em>
										</li>
									@endif

									<!-- end 文章标题 -->
									<h3>视频简介：</h3>
									<div class="aw-mod aw-editor-box">
										<div class="mod-head">
											<div class="wmd-panel">
												<script id="container" name="excerpt" type="text/plain" >{!! old('excerpt') !!}</script>
											</div>
										</div>
									</div>
									@if ($errors->has('excerpt'))
										<li class="alert alert-danger error_message" style="margin-top: 12px;">
											<i class="icon icon-delete"></i>
											<em>{{ $errors->first('excerpt') }}</em>
										</li>
									@endif

									<h3>本地视频：</h3>
									<div class="row">
										<div class="col-md-12 col-sm-12" >
											<div class="uploader white" style="width: 100%;">
												<input type="text" class="filename" style="width: 80%;" readonly />
												<input type="button" style="width: 20%;" class="button" value="Browse..."/>
												<input type="file" name="local_video" accept="video/*" value="{{ old('local_video') }}" size="30" multiple/>
											</div>
										</div>
									</div>
									@if ($errors->has('local_video'))
										<li class="alert alert-danger error_message">
											<i class="icon icon-delete"></i>
											<em>{{ $errors->first('local_video') }}</em>
										</li>
									@endif

									<div class="row">
                                        <div class="col-md-8 col-sm-8 ">
                                            <h3>添加话题(至多5个):</h3>
                                            <div class="aw-topic-bar active" data-type="publish">
                                                <div class="dropdown " id="cate">
                                                    <select data-placeholder="标签(选填)" name="tags[]" id="aw_edit_topic_title" multiple class="chosen-select form-control" tabindex="8">
                                                        @foreach($tags as $tag)
                                                            <option  value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                        @endforeach()
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <h3>　</h3>
                                            <div class="aw-topic-bar" data-type="publish">
                                                <div class="dropdown ">
                                                    <select class="form-control" name="status">
                                                        <option value="1">发布</option>
                                                        <option value="0">存草稿</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
								<div class="mod-footer clearfix">
									<input type="submit" class="btn btn-large btn-success btn-publish-submit" value="提交" />
								</div>
							</div>
						</form>
					</div>
					<!-- 侧边栏 -->
					<div class="col-sm-12 col-md-3 aw-side-bar hidden-xs">
						<!-- 文章发起指南 -->
						<div class="aw-mod publish-help">
							<div class="mod-head">
								<h3>视频发起指南</h3>
							</div>
							<div class="mod-body">
								<p><b>• 文章标题:</b> 请用准确的语言描述您发布的文章思想</p>
								<p><b>• 文章补充:</b> 详细补充您的文章内容, 并提供一些相关的素材以供参与者更多的了解您所要文章的主题思想</p>
								<p><b>• 选择话题:</b> 选择一个或者多个合适的话题, 让您发布的文章得到更多有相同兴趣的人参与. 所有人可以在您发布文章之后添加和编辑该文章所属的话题</p>
							</div>
						</div>
						<!-- end 文章发起指南 -->
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
	var editor = UE.getEditor('container',{
		//这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
		toolbars:[['bold', 'italic', 'underline','superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist','cleardoc', '|',
			'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
			'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|','indent', '|','justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|',
			'link','simpleupload', 'insertimage', 'emotion','insertvideo','attachment','insertcode','horizontal','spechars',
			'searchreplace',]],
		//focus时自动清空初始化时的内容
		autoClearinitialContent:true,
		//关闭字数统计
		wordCount:false,
		//关闭elementPath
		elementPathEnabled:false,
		//默认的编辑区域高度
		initialFrameHeight:320,
		autoClearinitialContent:true
	});
// 	标签设置
	var config = {
		'.chosen-select'           : {},
		'.chosen-select-deselect'  : {allow_single_deselect:true},
		'.chosen-select-no-single' : {disable_search_threshold:10},
		'.chosen-select-no-results': {no_results_text:'未找到该标签'},
		'.chosen-select-width'     : {width:"100%"}
	}
	for (var selector in config) {
		$(selector).chosen(config[selector]);
	}
});

</script>
<script>
	$(function(){
		$("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
		$("input[type=file]").each(function(){
			if($(this).val()==""){$(this).parents(".uploader").find(".filename").val("No file selected...");}
		});
	});
</script>
@stop
@endsection
