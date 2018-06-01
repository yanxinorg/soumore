@extends('layouts.ask')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('ask/avator/css/jquery.filer.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ask/avator/css/jquery.filer-dragdropbox-theme.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ask/avator/css/custom.css') }}">
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

	.jFiler {
		font-family: sans-serif;
		font-size: 14px;
		color: #494949;
		display: inline-block;
	}

	.jFiler-item-container {
        width: 100%;
		margin: 0 20px 30px 0;
		padding: 10px;
		border: 1px solid #e1e1e1;
		border-radius: 3px;
		background: #fff;
		-webkit-box-shadow: 0px 0px 3px rgba(0,0,0,0.06);
		-moz-box-shadow: 0px 0px 3px rgba(0,0,0,0.06);
		box-shadow: 0px 0px 3px rgba(0,0,0,0.06);
	}
    .jFiler-input-dragDrop {
        display: block;
        width: 343px;
        margin: 0 auto 15px auto;
        padding: 25px;
        color: #8d9499;
        color: #97A1A8;
        background: #fff;
        border: 2px dashed #C8CBCE;
        text-align: center;
        -webkit-transition: box-shadow 0.3s,
        border-color 0.3s;
        -moz-transition: box-shadow 0.3s,
        border-color 0.3s;
        transition: box-shadow 0.3s,
        border-color 0.3s;
    }
    .item .jFiler-item-container .jFiler-item-thumb .jFiler-item-thumb-image {
        width: 100%;
        height: 100%;
        text-align: center;
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
                            <li class="active"><a href="{{ url('/video/create') }}">视频</a></li>
							<li ><a href="{{ url('/post/create') }}">文章</a></li>
							<li><a href="{{ url('/question/create') }}">问题</a></li>
							<h2 class="hidden-xs"><i class="icon icon-ask"></i> 发起</h2>
						</ul>
						<!-- end tab 切换 -->
						<form action="{{ url('/video/update') }}" method="post" enctype="multipart/form-data" onkeydown="if(event.keyCode==13)return false;">
                            {{ csrf_field() }}
                            <div class="form-group" hidden><input type="text" name="id" value="{{ $datas->id }}" class="form-control" ></div>
							<div class="aw-mod aw-mod-publish">
								<div class="mod-body">
									<h3>视频标题:</h3>
									<div class="aw-publish-title">
                                        <!-- 视频标题 -->
										<input type="text"  class="form-control"  name="title" value="{{ $datas->title }}" >
										{{--视频分类--}}
										<div class="dropdown " id="cate">
											<select data-placeholder="选择分类..." class="chosen-select form-control"   tabindex="4" name="cid">
												@foreach($cates as $cate)
													@if(!empty(old('cid')))
														@if($cate->id == old('cid') )
															<option style="height:33px;line-height:24px;" value="{{ $cate->id }}" selected="selected">{{ $cate->name }}</option>
														@else
															<option style="height:33px;line-height:24px;" value="{{ $cate->id }}" >{{ $cate->name }}</option>
														@endif
													@elseif($cate->id == $datas->cate_id )
														<option style="height:33px;line-height:24px;" value="{{ $cate->id }}" selected="selected">{{ $cate->name }}</option>
													@else
														<option style="height:33px;line-height:24px;" value="{{ $cate->id }}" >{{ $cate->name }}</option>
													@endif
												@endforeach()
											</select>
										</div>
									</div>

                                    <h3>原图:</h3>
                                    <div class="aw-mod aw-user-setting-bind">
                                        <ul class="jFiler-items-list jFiler-items-grid">
                                            <li class="jFiler-item" style="width: 100%;" data-jfiler-index="0">
                                                <div class="jFiler-item-container">
                                                    <div class="jFiler-item-inner">
                                                        <div class="jFiler-item-thumb">
                                                            <div class="jFiler-item-thumb-image">
                                                                <img src="{{ $datas->thumb }}" draggable="false">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    {{--缩略图上传--}}
                                    <h3>视频头图:</h3>
                                    <div class="aw-mod aw-user-setting-bind">
                                        <div style="clear: both;"></div>
                                        <input type="file" name="thumb" style="float:left;" id="demo-fileInput-4" multiple>
                                    </div>
									<!-- end 文章标题 -->
									<h3>视频简介:</h3>
									<div class="aw-mod aw-editor-box">
										<div class="mod-head">
											<div class="wmd-panel">
												<script id="container" name="excerpt" type="text/plain" >{!! $datas->excerpt !!}</script>
											</div>
										</div>
									</div>
									<h3>上传视频:</h3>
									<div class="row">
										<div class="col-md-4 col-sm-4">
											<div class="aw-topic-bar">
												<div class="dropdown ">
													<select class="form-control" name="video" id="upload_video">
														<option value="1">本地上传</option>
														<option value="0">第三方链接</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-8 col-sm-8" id="local_video">
											<div class="aw-mod aw-editor-box">
												<div class="mod-head">
													<div class="wmd-panel">
														<input type="file" name="local_video"　value="{{ $datas->url }}" class="form-control" multiple>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-8 col-sm-8" style="display: none;" id="third_video">
											<div class="aw-mod aw-editor-box">
												<div class="mod-head">
													<div class="wmd-panel">
														<input type="text" name="third_video"　value="{{ $datas->url }}" class="form-control" placeholder="例如：http://www.soumore.cn">
													</div>
												</div>
											</div>
										</div>
									</div>
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8 ">
                                            <h3>添加话题(至多5个):</h3>
                                            <div class="aw-topic-bar active" data-type="publish">
                                                <div class="dropdown " id="cate">
													<select data-placeholder="标签(选填)" name="tags[]" id="aw_edit_topic_title" multiple class="chosen-select form-control" tabindex="8">
														@foreach($tags as $tag)
															@if(in_array($tag->id,$selectedTags))
																<option  value="{{ $tag->id }}" selected="selected">{{ $tag->name }}</option>
															@else
																<option  value="{{ $tag->id }}">{{ $tag->name }}</option>
															@endif
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
														@if($datas->status == 1)
															<option value="1" selected>发布</option>
															<option value="0" >存草稿</option>
														@else
															<option value="1" >发布</option>
															<option value="0" selected>存草稿</option>
														@endif
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
<script src="{{ asset('ask/avator/js/jquery.filer.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/avator/js/prettify.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/avator/js/scripts.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/avator/js/custom.js') }}" type="text/javascript"></script>
<script src="{{ asset('ask/chosen/chosen.jquery.js') }}"></script>
<script type="text/javascript">
jQuery(function(){
	//视频上传
	$("#upload_video").change(function () {
		if($("#upload_video").val() == '1')
		{
			$("#local_video").css("display","inline-block");
			$("#third_video").css("display","none");
		}else
		{
			$("#local_video").css("display","none");
			$("#third_video").css("display","inline-block");
		}

	});
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
		initialFrameHeight:200,
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

    // 设置初始化内容
    var proinfo=$("#container").text();
    editor.ready(function() {//编辑器初始化完成再赋值
        editor.setContent(proinfo);  //赋值给UEditor
    });

});

</script>
@stop
@endsection
