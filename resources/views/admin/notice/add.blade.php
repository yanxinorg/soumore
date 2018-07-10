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
                            <div class="ibox-tools">
                               <div class="pull-right">
                                    <a type="button" class="btn btn-sm btn-white" href="{{ url('/back/notice/list') }}"> <i class="fa fa-list">列表</i></a>
                               </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="{{ url('/back/notice/store') }}" class="form-horizontal" >
                                {{ csrf_field() }}
                               <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">公告名称</label>
                                    <div class="col-sm-6">
                                    	<input type="text" class="form-control" name="title">
                                    </div>
                                    <div class="col-sm-2">
	                              		 @if ($errors->has('name'))
	                              		 	<span class="label label-danger">{{ $errors->first('title') }}</span>
								         @endif
	                              	</div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">公告内容</label>
                                     <div class="col-sm-6">
                                         <script id="container" name="content" type="text/plain" >{!! old('content') !!}</script>
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
<script>
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
            initialFrameHeight:400,
            autoClearinitialContent:true
        });
    });
</script>
@stop
@endsection
