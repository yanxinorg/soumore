@extends('layouts.wenda')
@section('content')
@include('UEditor::head')
<!-- 标签 -->
<link rel="stylesheet" href="{{ asset('wenda/post/css/chosen.css') }}">
<!-- 文章 -->
<link rel="stylesheet" type="text/css" href="{{ asset('wenda/post/css/jquery.filer.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('wenda/post/css/jquery.filer-dragdropbox-theme.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('wenda/post/css/custom.css') }}">
<style>
.main-content .backrerror{
	height:42px;
	line-height:42px;
	text-align:center;
}
.main-content .backsuccess{
	height:42px;
	line-height:42px;
	text-align:center;
	background-color:#F4F4F4;
}
.tokenfield {
    min-height: 40px;
}
body{
	line-height:1.25;
}
</style>
<div class="main-content" >
     <div class="wrapper">
                <form action="{{ url('/post/store') }}" class="form-horizontal" method="post" enctype="multipart/form-data" onkeydown="if(event.keyCode==13)return false;">
	                <div class="col-md-8 col-md-offset-2  col-sm-12" style="background-color:white;padding-top:24px;">
                      		{{ csrf_field() }}
                           <div class="form-group">
                                <div class="col-md-8 col-md-offset-2 col-sm-10">
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="标题(必填)">
                                </div>
                                <div class="col-md-2 col-sm-2">
                              		 @if ($errors->has('title'))
							            <div class="alert-danger backrerror"  >
							                 {{ $errors->first('title') }}
							            </div>
							         @else
							          <div class="alert-danger backsuccess" >
						            	<span>至少2字符</span>
						              </div>
							         @endif
                              	</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8  col-md-offset-2  col-sm-10">
                                    <input type="file" name="cover" id="demo-fileInput-4" multiple>
                                </div>
                                <div class="col-md-2 col-sm-2">
                              		 @if ($errors->has('cover'))
							            <div class="alert-danger backrerror" >
							                 {{ $errors->first('cover') }}
							            </div>
							         @else
							          <div class="alert-danger backsuccess" >
						            	<span>图片2M以内</span>
						              </div>
							         @endif
                              	</div>
                            </div>
                            
                           <div class="form-group">
    	                        <div class="col-md-8 col-md-offset-2  col-sm-10">
    	                            <script id="container" name="content" type="text/plain" >{!! old('content') !!}</script>
    	                        </div>
    	                        <div class="col-md-2 col-sm-2">
                              		  @if ($errors->has('content'))
							            <div class="alert-danger backrerror" >
							                 {{ $errors->first('content') }}
							            </div>
							          @else
							           <div class="alert-danger backsuccess" >
						            	<span>至少10字符</span>
						               </div>
							          @endif
                              	</div>
                              	
    	                    </div>
    	                    <div class="form-group">
                              <div class="col-md-4 col-sm-5 col-md-offset-2 ">
                                  <select class="form-control" name="cid">
                                      @foreach($cates as $cate)
                                      		@if(!empty(old('cid')))
                                      			@if($cate->id == old('cid'))
		                                      		<option value="{{ $cate->id }}">{{ $cate->name }}</option>
		                                      	@else
		                                      		<option value="{{ $cate->id }}" >{{ $cate->name }}</option>
                                      			@endif
                                      		@else
                                      			<option value="{{ $cate->id }}" >{{ $cate->name }}</option>
                                      		@endif
                                      @endforeach()
                                  </select>
                              </div>
                              <div class="col-md-4 col-sm-5">
	                                  <select class="form-control" name="status">
	                                      <option value="1">发布</option>
	                                      <option value="0">存草稿</option>
	                                  </select>
	                          </div>
                          </div>
                          <div class="form-group">
                              <div class="col-md-8 col-sm-10 col-md-offset-2 ">
                                   <select data-placeholder=" 标签(选填)" name="tags[]" multiple class="form-control chosen-select" tabindex="8">
                                   		@foreach($tags as $tag)
								         <option value="{{ $tag->id }}">{{ $tag->name }}</option>
								        @endforeach()
								   </select>
                              </div>
                              <div class="col-md-2 col-sm-2">
						            <div class="alert-danger backsuccess" >
						            	<span>最多5个标签</span>
						            </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-md-10 col-sm-10 col-md-offset-8 ">
                                <button type="submit" class="btn btn-success">提交</button>
                              </div>
                          </div>
	                </div>
                </form>
     </div>
</div>
@section('js')
@parent
<!-- 标签插件 -->
<script src="{{ asset('wenda/post/js/chosen.jquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('wenda/post/js/docsupport/prism.js') }}" type="text/javascript" ></script>
<!-- 头图 -->
<script src="{{ asset('wenda/post/js/jquery.filer.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('wenda/post/js/prettify.js') }}" type="text/javascript"></script>
<script src="{{ asset('wenda/post/js/scripts.js') }}" type="text/javascript"></script>
<script src="{{ asset('wenda/post/js/custom.js') }}" type="text/javascript"></script>
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
	    initialFrameHeight:600,
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
@stop
@endsection
