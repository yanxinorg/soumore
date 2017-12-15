@extends('layouts.back')
@section('content')
@include('UEditor::head');
<link href="{{ asset('back/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('back/css/style-responsive.css') }}" rel="stylesheet">
<style>
img{
width:100%;
}
</style>
<section class="wrapper ">
    <div class="row">
            <div class="col-lg-8 col-sm-8">
                <section class="panel">
    	            <header class="panel-heading">新增公告</header>
    	            <div class="panel-body">
    	                <form class="form-horizontal adminex-form" method="post" action="{{ url('/notice/create') }}" enctype="multipart/form-data">
    	                {{ csrf_field() }}
    	                    <div class="form-group">
    	                        <label class="col-sm-2 col-sm-2 control-label"><span style="color: red;">*</span>公告标题</label>
    	                        <div class="col-sm-6 col-sm-6">
    	                            <input type="text" name="title" class="form-control">
    	                        </div>
    	                          @if ($errors->has('name'))
    	                          <div class="col-sm-4 col-sm-4">
                                     <span style="color:red;">{{ $errors->first('name') }}</span>
    	                          </div>
                             	  @endif
    	                    </div>
    	                    <div class="form-group">
    	                        <label class="col-sm-2 col-sm-2 control-label">发布人</label>
    	                        <div class="col-sm-6 col-sm-6">
    	                            <input type="text" name="author" class="form-control">
    	                        </div>
    	                          @if ($errors->has('name'))
    	                          <div class="col-sm-4 col-sm-4">
                                     <span style="color:red;">{{ $errors->first('name') }}</span>
    	                          </div>
                             	  @endif
    	                    </div>
    	                     <div class="form-group">
    	                        <label class="col-sm-2 col-sm-2 control-label">公告链接</label>
    	                        <div class="col-sm-6 col-sm-6">
    	                            <input type="text" name="url" class="form-control">
    	                        </div>
    	                          @if ($errors->has('name'))
    	                          <div class="col-sm-4 col-sm-4">
                                     <span style="color:red;">{{ $errors->first('name') }}</span>
    	                          </div>
                             	  @endif
    	                    </div>
    	                    <div class="form-group">
    	                        <label class="col-sm-2 col-md-2 control-label"><span style="color: red;">*</span>公告内容</label>
    	                        <div class="col-md-6 col-sm-6">
    	                            <script id="container" name="content" type="text/plain"></script>
    	                        </div>
    	                    </div>
    						<div class="form-group">
                                <label class="col-sm-2 control-label"><span style="color: red;">*</span>状态</label>
                                <div class="col-sm-10 icheck minimal">
                                    <div class="radio-inline ">
                                        <input type="radio"  name="status" value="1" checked>
                                        <label>发布</label>
                                    </div>
                                    <div class="radio-inline ">
                                        <input type="radio"  name="status" value="0" >
                                        <label>不发布</label>
                                    </div>
                                </div>
                            </div>
                             @if ($errors->has('msg'))
                               <div class="form-group">
                                <div class="col-md-12">
                                   <span style="color:red;">{{ $errors->first('msg') }}</span>
                                </div>
                            </div>
                             @endif
    	                    <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                            </div>
    	                </form>
    	            </div>
            	</section>
            </div>
             <div class="col-lg-4 col-sm-4">
                <section class="panel">
                    <header class="panel-heading">
                   	<span>公告内容</span> 
                    <a href="{{ route('notice.edit',['id'=>$data->id]) }}" class="btn btn-success  btn-sm pull-right">编辑</a>
                    </header>
                    
                    <div class="panel-body">
                     	<h4 style="text-align: center;">{{ $data->title }}</h4>
                     	{!! $data->content !!}
                    </div>
                </section>
            </div>
    </div>
</section>
@section('js')
@parent
<script type="text/javascript">
	var editor = UE.getEditor('container',{  
	    //这里可以选择自己需要的工具按钮名称,此处仅选择如下五个  
	    toolbars:[  
            [ 'source', '|', 'undo', 'redo', '|',  
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',  
                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',  
                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',  
                'directionalityltr', 'directionalityrtl', 'indent', '|',  
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',  
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',  
                'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe','insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',  
                'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',  
                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',  
                'print', 'preview', 'searchreplace', 'help', 'drafts']  
        ] ,  
	    //focus时自动清空初始化时的内容  
	    autoClearinitialContent:true,  
	    //关闭字数统计  
	    wordCount:false,  
	    //关闭elementPath  
	    elementPathEnabled:false,  
	    //默认的编辑区域高度  
	    initialFrameHeight:300  
	    //更多其他参数，请参考ueditor.config.js中的配置项  
	});  
</script>
@stop
@endsection
