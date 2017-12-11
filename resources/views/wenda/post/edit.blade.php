@extends('layouts.wenda')
@section('content')
<!-- include summernote css/js-->
<link href="{{ asset('wenda/summernote/summernote.css') }}" rel="stylesheet">
<!-- tags -->
<link href="{{ asset('wenda/tags/css/bootstrap-tokenfield.css') }}" rel="stylesheet">
<link href="{{ asset('wenda/tags/css/tokenfield-typeahead.css') }}" rel="stylesheet">
<style>
.main-content{
  padding-top: 36px;
}
.main-content .must{
	color:red;
}
.main-content .backrerror{
	height:42px;
	line-height:42px;
	text-align:center;
}
</style>
<div class="main-content">
     <div class="wrapper">
            <div class="row">
                <div class="col-md-2 " ></div>
                <div class="col-md-8 ">
                      <div class="panel">
                          <div class="panel-body">
	                      <form action="{{ url('/post/update') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
	                      {{ csrf_field() }}
	                          <div class="form-group">
	                              <label class="col-md-2 control-label "><span class="must" >*</span>分类</label>
	                              <div class="col-md-6">
	                                  <select class="form-control" name="cid">
	                                      @foreach($cates as $cate)
	                                      		@if(!empty(old('cid')))
	                                      			@if($cate->id == old('cid') )
			                                      		<option value="{{ $cate->id }}" selected="selected">{{ $cate->name }}</option>
			                                      	@else
			                                      		<option value="{{ $cate->id }}" >{{ $cate->name }}</option>
	                                      			@endif
	                                      		@elseif($cate->id == $datas->cate_id )
	                                      			<option value="{{ $cate->id }}" selected="selected">{{ $cate->name }}</option>
	                                      		@else
	                                      			<option value="{{ $cate->id }}" >{{ $cate->name }}</option>
	                                      		@endif
	                                      @endforeach()
	                                  </select>
	                              </div>
	                              <div class="col-md-2">
	                              		<label class="control-label ">带<span  class="must" >*</span>为必填项</label>
	                              		 @if ($errors->has('cid'))
								            <div class="alert alert-danger" >
								                 {{ $errors->first('cid') }}
								            </div>
								         @endif
	                              </div>
	                          </div>
	                          	<div class="form-group" hidden>
	                                <div class="col-md-6">
	                                    <input type="text" name="id" value="{{ $datas->id }}" class="form-control" >
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label for="inputEmail1" class="col-md-2 control-label"><span class="must" >*</span>标题</label>
	                                <div class="col-md-6">
	                                    <input type="text" name="title" value="{{ $datas->title }}" class="form-control" placeholder="标题">
	                                </div>
	                                <div class="col-md-2">
	                              		 @if ($errors->has('title'))
								            <div class="alert-danger backrerror"  >
								                 {{ $errors->first('title') }}
								            </div>
								         @endif
	                              	</div>
	                            </div>
	                            <div class="form-group">
	                                <label class="col-md-2 control-label ">封面图</label>
	                                <div class="col-md-6">
	                                    <div class="thumbnail"><img src="{{ route('getPostImg', $datas->id) }}"></div>
	                                    <input type="file" name="cover" class="default" />
	                                </div>
	                                <div class="col-md-2">
	                              		<span class="label label-danger">最大上传2M图片</span>
	                              	</div>
	                              	<div class="col-md-2">
	                              		 @if ($errors->has('cover'))
								            <div class="alert-danger backrerror" >
								                 {{ $errors->first('cover') }}
								            </div>
								         @endif
	                              	</div>
	                            </div>
	                          <div class="form-group">
	                              <label class="col-md-2 control-label "><span class="must" >*</span>内容</label>
	                              <div class="col-md-10">
	                                  <div id="summernote">{!! $datas->content !!}</div>
	                              </div>
	                               <input type="hidden" id="summernote_content" value="{{ old('content') }}" name="content" />
	                          </div>
	                           @if ($errors->has('content'))
	                          <div class="form-group">
	                          	  <div class="col-md-2"></div>
		                          <div class="col-md-10">
								        <div class="alert-danger backrerror" >
							               {{ $errors->first('content') }}
							            </div>
		                          </div>
	                          </div>
	                          @endif
	                          <div class="form-group">
	                          	<label class=" col-md-2 control-label">标签</label>
	                              <div class="col-md-6">
	                                <input type="text" class="form-control" value="{{ $selectedTags }}" name="tags[]" id="tokenfield-typeahead" />
	                              </div>
	                              <div class="col-md-2">
	                              		 @if ($errors->has('tags.*'))
								            <div class="alert-danger backrerror" >
								            	<span>标签长度超出范围</span>
								            </div>
								         @endif
	                              </div>
	                          </div>
	                          <div class="form-group">
	                              <label class="col-md-2 control-label"><span class="must" >*</span>状态</label>
	                              <div class="col-md-3 col-lg-3">
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
	                          <div class="form-group">
	                             <label class="col-md-2 control-label"></label>
	                              <div class="col-md-10">
	                                <button type="submit" class="btn btn-success">提交</button>
	                              </div>
	                          </div>
	                      </form>
                      </div>
                      </div>
                </div>
                <div class="col-md-2 ">
                 
                </div>
            </div>
     </div>
</div>
@section('js')
@parent
<script type="text/javascript" src="{{ URL::asset('wenda/summernote/summernote.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('wenda/summernote/lang/summernote-zh-CN.js') }}"></script>
<!-- tags插件 -->
<script type="text/javascript" src="{{ URL::asset('wenda/tags/bootstrap-tokenfield.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('wenda/tags/typeahead.bundle.min.js') }}"></script>
<script type="text/javascript">
//tag初始化
jQuery(function(){
	 var $summernote = $('#summernote').summernote({
		 lang: 'zh-CN',
         height: 480,
         minHeight: null,
         maxHeight: null,
         focus: true,
         //调用图片上传
         callbacks: {
        	 onInit: function() {
        		 var content = $('#summernote').summernote('code');
		          $("#summernote_content").val(content);
        	    },
	         onChange:	function (contents, $editable) 
	         {
	        	 var content = $('#summernote').summernote('code');
		          $("#summernote_content").val(content);
	          },
             onImageUpload: function (files) 
             {
                 sendFile($summernote, files[0]);
             }
         }
     });
     //ajax上传图片
     function sendFile($summernote, file) {
         var formData = new FormData();
         formData.append("file", file);
         formData.append("_token",'{{ csrf_token() }}');
         $.ajax({
             url: "{{ url('/post/image/upload') }}",//路径是你控制器中上传图片的方法，下面controller里面我会写到
             data: formData,
             cache: false,
             contentType: false,
             processData: false,
             type: 'POST',
             success: function (data) {
                 var imgUrl = "{{ url('post/images/') }}/"+data;
                 $summernote.summernote('insertImage', imgUrl, function ($image) {
                     $image.attr('src',imgUrl);
                 });
             }
         });
     }
     
	var engine = new Bloodhound({
		  local: [@foreach($tags as $tag) {value: '{{ $tag->name }}'}, @endforeach],
		  datumTokenizer: function(d) {
		    return Bloodhound.tokenizers.whitespace(d.value);
		  },
		  queryTokenizer: Bloodhound.tokenizers.whitespace
		});
		engine.initialize();
		$('#tokenfield-typeahead').tokenfield({
		  typeahead: [null, { source: engine.ttAdapter() }]
		});
});
</script>
@stop
@endsection
