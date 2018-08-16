@extends('layouts.ask')
@section('content')
<link href="{{ asset('ask/chosen/chosen.css') }}" rel="stylesheet">
<link href="{{ asset('ask/css/video.css') }}" rel="stylesheet">
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
									<h3>视频标题：</h3>
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

                                    <h3>原图：</h3>
									<div class="row">
										<div class="col-md-6 col-sm-6" >
											<img src="{{ $datas->thumb }}" style="max-height: 200px;">
										</div>
									</div>

                                    {{--缩略图上传--}}
                                    <h3>视频头图：</h3>
									<div class="row">
										<div class="col-md-12 col-sm-12" >
											<div class="uploader white" style="width: 100%;">
												<input type="text" class="filename" value="{{ $datas->thumb }}" style="width: 80%;" readonly />
												<input type="button" style="width: 20%;" class="button" value="Browse..."/>
												<input type="file" name="thumb" accept="image/*" size="30" multiple/>
											</div>
										</div>
									</div>

									<!-- end 文章标题 -->
									<h3>视频简介：</h3>
									<div class="aw-mod aw-editor-box">
										<div class="mod-head">
											<div class="wmd-panel">
												<script id="container" name="excerpt" type="text/plain" >{!! $datas->excerpt !!}</script>
											</div>
										</div>
									</div>

									<h3>本地视频：</h3>
									<div class="row">
										<div class="col-md-12 col-sm-12" >
											<div class="uploader white" style="width: 100%;">
												<input type="text" class="filename" value="{{ $datas->url }}"  style="width: 80%;" readonly />
												<input type="button" style="width: 20%;" class="button" value="Browse..."/>
												<input type="file" name="local_video" accept="video/*"  size="30" multiple/>
											</div>
										</div>
									</div>

                                    <div class="row">
                                        <div class="col-md-8 col-sm-8 ">
                                            <h3>添加话题(至多5个)：</h3>
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
<script>
	$(function(){
		$("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
		$("input[type=file]").each(function(){
			$(this).parents(".uploader").find(".filename").val() == $(this).val();
		});
	});
</script>
@stop
@endsection
