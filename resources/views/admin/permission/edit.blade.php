@extends('layouts.admin')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
 <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="ibox-tools">
                               <div class="pull-right">
                               		<a type="button" class="btn btn-sm btn-white" href="{{ url('/back/permit/list') }}"> <i class="fa fa-arrow-left">后退</i></a>
                                    <a type="button" class="btn btn-sm btn-white" href="{{ url('/back/permit/list') }}"> <i class="fa fa-list">列表</i></a>
                               </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" action="{{ url('/back/permit/update') }}">
                            {{ csrf_field() }}
                            	<div class="form-group">
                                    <input type="text" class="form-control hidden" name="id" value="{{ $data->id }}">
                                </div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">路由名称</label>
                                    <div class="col-sm-6">
                                    	<input type="text" class="form-control" name="urlname" value="{{ $data->name }}" placeholder="eg：post.edit">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">路由别名</label>
                                    <div class="col-sm-6">
                                    	<input type="text" class="form-control" name="urlalias" value="{{ $data->display_name }}" placeholder="eg：编辑文章">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">路由备注</label>
                                    <div class="col-sm-6">
                                    	<textarea class="form-control" name="urlremark" rows="3">{{ $data->description }}</textarea>
                                    </div>
                                </div>
                               <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-2 col-sm-offset-7">
                                        <button class="btn btn-md btn-primary" type="submit">提交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
@endsection
