@extends('layouts.back')
@section('content')
<link href="{{ asset('back/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('back/css/style-responsive.css') }}" rel="stylesheet">
<style>
.col-md-12{
	background-color:white;
}
.col-md-2 .panel .panel-body img{
width:100%;
}
</style>
<section class="wrapper ">
         <section class="panel">
	        <header class="panel-heading">
	           	公告列表
	            <span class="tools pull-right">
	                <a href="{{ route('notice.create') }}" >新增公告</a>
	             </span>
	        </header>
	        <div class="panel-body">
	        		@foreach($datas as $data )
				         <div class="col-md-2 col-sm-2" >
			                 <section class="panel" style="background-color:#EFF0F4;">
			                    <header class="panel-heading">
			                    	<a href="{{ route('notice.edit',['id'=>$data->id]) }}" class="btn btn-success  btn-sm">编辑</a>
			                    	<a href="{{ route('notice.delete',['id'=>$data->id]) }}" class="btn btn-danger btn-sm">删除</a>
			                    </header>
			                    <div class="panel-body">
			                     	<h4 style="text-align: center;">{{ $data->title }}</h4>
			                     	{!! $data->content !!}
			                    </div>
			                </section>
		            	</div>
	            	@endforeach()
	        </div>
        </section>
</section>
@endsection
