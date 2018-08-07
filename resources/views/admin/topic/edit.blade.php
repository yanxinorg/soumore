@extends('layouts.admin')
@section('content')
<link href="{{ asset('back/admin/css/plugins/chosen/chosen.css') }}" rel="stylesheet">
<link href="{{ asset('back/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
<link href="{{ asset('back/admin/css/fileinput.min.css') }} " rel="stylesheet" type="text/css" />
<link href="{{ asset('back/admin/css/style.css') }} " rel="stylesheet">
<div class="wrapper wrapper-content animated fadeInRight">
@include('UEditor::head')
 <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                           <div class="pull-right">
                                <a type="button" class="btn btn-sm btn-white" href="{{ url('/back/topic/list') }}"> <i class="fa fa-list">列表</i></a>
                           </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="{{ url('/back/topic/store') }}" class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                 <div class="form-group" hidden>
			                          <input type="text" name="id" class="form-control" value="{{ $topic->id }}">
			                     </div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">话题名称</label>
                                    <div class="col-sm-6">
                                    	<input type="text" class="form-control" name="name" value="{{ $topic->name }}">
                                    </div>
                                     <div class="col-sm-2">
	                              		 @if ($errors->has('name'))
	                              		 	<span class="label label-danger">{{ $errors->first('name') }}</span>
								         @endif
	                              	</div>
                                </div>
                               
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">缩略图</label>
                                    <div class="col-sm-6">
                                    	<div class="file-preview-frame krajee-default  kv-preview-thumb" id="preview-1516346124078_80-0" data-fileindex="0" data-template="image">
	                                    	<div class="kv-file-content">
												<img src="{{ $topic->thumb }}" class="file-preview-image kv-preview-data rotate-1" title="cover.jpg" alt="cover.jpg" style="width:auto;height:auto;max-width:100%;max-height:100%;">
											</div>
											<div class="file-thumbnail-footer">
												<div class="clearfix"></div>
											</div>
										</div>
                                    	<input id="input-id" type="file" name="thumb" class="file" data-preview-file-type="text" >
                                    </div>
                                    <div class="col-sm-2 ">
	                              		 @if ($errors->has('thumb'))
	                              		 	<span class="label label-danger">{{ $errors->first('thumb') }}</span>
								         @else
								         	<span class="label label-success">图片2M以内</span>
								         @endif
                              		</div>
                                </div>
                                
			                   <div class="hr-line-dashed"></div>
			                   <div class="form-group">
			                		<label class="col-sm-2 control-label">所属分类</label>
				                	<div class="col-sm-6">
					                	<select data-placeholder="Choose a Country..." class="chosen-select form-control"  tabindex="4" name="cateid">
							                @foreach($cates as $cate )
							                	@if($topic->cate_id == $cate->id )
				                                    <option  value="{{ $cate->id }}" selected>{{ $cate->name }}</option>
				                                @else
				                                	<option  value="{{ $cate->id }}" >{{ $cate->name }}</option>
				                                 @endif
							                @endforeach()
						                </select>
					                </div>
					                 <div class="col-sm-2">
	                              		 @if ($errors->has('cateid'))
	                              		 <span class="label label-danger">{{ $errors->first('cateid') }}</span>
								         @endif
	                              	</div>
				                </div>
				                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">状态</label>
                                    <div class="col-sm-6">
                                    	 @if($topic->status == 1)
	                						<div class="radio radio-info radio-inline">
	                                            <input type="radio" id="inlineRadio1" value="1" name="status" checked="checked">
	                                            <label for="inlineRadio1">启用</label>
	                                        </div>
	                                        <div class="radio radio-inline">
	                                            <input type="radio" id="inlineRadio2" value="0" name="status">
	                                            <label for="inlineRadio2">禁用</label>
	                                        </div>
		                				@else
		                					<div class="radio radio-info radio-inline">
	                                            <input type="radio" id="inlineRadio1" value="1" name="status" >
	                                            <label for="inlineRadio1">启用</label>
	                                        </div>
	                                        <div class="radio radio-inline">
	                                            <input type="radio" id="inlineRadio2" value="0" name="status" checked="checked">
	                                            <label for="inlineRadio2">禁用</label>
	                                        </div>
		                				@endif
                                    </div>
                                    <div class="col-sm-2">
	                              		 @if ($errors->has('status'))
	                              		 	<span class="label label-danger">{{ $errors->first('status') }}</span>
								         @endif
	                              	</div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">话题描述</label>
                                     <div class="col-sm-6">
                                         <script id="container" name="desc" type="text/plain" >{!! $topic->desc !!}</script>
                                     </div>
                                </div>
                                
                               <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-2 col-sm-offset-7">
                                        <button class="btn btn-primary" type="submit">提交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
@section('js')
@parent
<!-- Chosen -->
<script src="{{ asset('back/admin/js/plugins/chosen/chosen.jquery.js') }}"></script>
<!-- the main fileinput plugin file -->
<script src="{{ asset('back/admin/js/fileinput.min.js') }}"></script>
    <script>
        $(document).ready(function(){
// 			头像上传初始化
			$("#input-id").fileinput();
            //编辑器初始化
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
                initialFrameHeight:400,
                autoClearinitialContent:true
            });
            // 设置初始化内容
            var proinfo=$("#container").text();
            editor.ready(function() {//编辑器初始化完成再赋值
                editor.setContent(proinfo);  //赋值给UEditor
            });
        });
        var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
    </script>
@stop
@endsection
