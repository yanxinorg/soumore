@extends('layouts.admin')
@section('content')
<link href="{{ asset('back/admin/css/plugins/chosen/chosen.css') }}" rel="stylesheet">
<link href="{{ asset('back/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
<link href="{{ asset('back/admin/css/fileinput.min.css') }} " rel="stylesheet" type="text/css" />
<link href="{{ asset('back/admin/css/style.css') }} " rel="stylesheet">
<link href="{{ asset('back/datetime/daterangepicker.css') }} " rel="stylesheet">
<link href="{{ asset('back/datetime/bootstrap-datetimepicker.min.css') }} " rel="stylesheet">
<div class="wrapper wrapper-content animated fadeInRight">
@include('UEditor::head')
 <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="ibox-tools">
                       <div class="pull-right">
                            <a type="button" class="btn btn-sm btn-white" href="{{ url('/back/post/list') }}"> <i class="fa fa-list">列表</i></a>
                       </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="post" action="{{ url('/back/post/store') }}" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                       <div class="hr-line-dashed"></div>
                       <div class="form-group">
                            <label class="col-sm-2 control-label">所属分类</label>
                            <div class="col-sm-6">
                                <select data-placeholder="Choose a Category..." class="chosen-select form-control"  tabindex="4" name="cid">
                                    @foreach($cates as $cate)
                                        <option  value="{{ $cate->id }}">
                                        @if( $cate->count != 0)
                                            @for ($i=0;$i<$cate->count;$i++)
                                                @if( $i == 0)
                                                <span>|---</span>
                                                @else
                                                <span>---</span>
                                                @endif
                                            @endfor
                                        {{ $cate->name }}
                                        @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                 @if ($errors->has('cate_id'))
                                 <span class="label label-danger">{{ $errors->first('cid') }}</span>
                                 @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">文章标题</label>
                            <div class="col-sm-6">
                                <input type="text"  name="title"　value="{{ old('title') }}"  class="form-control" required />
                            </div>
                            <div class="col-sm-2">
                                 @if ($errors->has('name'))
                                    <span class="label label-danger">{{ $errors->first('title') }}</span>
                                 @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">文章作者</label>
                            <div class="col-sm-6">
                                <input type="text"  name="author"　value="{{ old('author') }}"  class="form-control" />
                            </div>
                            <div class="col-sm-2">
                                @if ($errors->has('author'))
                                    <span class="label label-danger">{{ $errors->first('author') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">发布时间</label>
                            <div class="col-sm-6">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" name="publish_time" value="" id="datetimepicker" class="form-control" data-date-format="yyyy-mm-dd hh:ii">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                @if ($errors->has('publish_time'))
                                    <span class="label label-danger">{{ $errors->first('publish_time') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">文章头图</label>
                            <div class="col-sm-6">
                                <input id="input-id" type="file" name="thumb" class="file" data-preview-file-type="text">
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
                            <label class="col-sm-2 control-label">文章内容</label>
                            <div class="col-sm-6">
                                <script id="container" name="content" type="text/plain" >{!! old('content') !!}</script>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">话题标签</label>
                            <div class="col-lg-6">
                                <select data-placeholder="Choose a Tags..." class="chosen-select form-control" name="tags[]" multiple tabindex="4">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach()
                                </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">文章状态</label>
                            <div class="col-sm-6">
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="inlineRadio1" value="1" name="status" checked="checked">
                                    <label for="inlineRadio1">发布</label>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" id="inlineRadio2" value="0" name="status">
                                    <label for="inlineRadio2">存草稿</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                 @if ($errors->has('status'))
                                    <span class="label label-danger">{{ $errors->first('status') }}</span>
                                 @endif
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
<script src="{{ asset('back/datetime/date.js') }}"></script>
<script src="{{ asset('back/datetime/daterangepicker.js') }}"></script>
<script src="{{ asset('back/datetime/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('back/datetime/bootstrap-datetimepicker.zh-CN.js') }}"></script>
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

        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
            '.chosen-select-width'     : {width:"95%"}
        };
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }

    });
</script>
<script>
    $(document).ready(function(){
        Date.prototype.Format = function (fmt) { //author: meizz
            var o = {
                "M+": this.getMonth() + 1, //月份
                "d+": this.getDate(), //日
                "h+": this.getHours(), //小时
                "m+": this.getMinutes(), //分
                "s+": this.getSeconds(), //秒
                "q+": Math.floor((this.getMonth() + 3) / 3), //季度
                "S": this.getMilliseconds() //毫秒
            };
            if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
            for (var k in o)
                if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
            return fmt;
        }
        var time = new Date().Format("yyyy-MM-dd hh:mm");
        $("#datetimepicker").val(time);
    });
    //时间选择器
    $('#datetimepicker').datetimepicker({
        autoclose:true,//自动关闭
        initialDate: new Date(),
        todayHighlight:true,
        todayBtn:true,
        language:'zh-CN'
    });

</script>

@stop
@endsection

