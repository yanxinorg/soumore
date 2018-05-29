@extends('layouts.ask')
@section('content')
<style>
.mail-list{
	height:auto;
}
img{
max-width:100%
}
.bl-status{
	font-size:12px;
}
</style>
<?php
use App\Models\Common\UserModel;
?>
<div class="main-content">
  <div class="wrapper">
      <div class="directory-info-row">
      <div class="col-md-2 col-sm-2" >
      </div>
          <div class="col-md-8 col-sm-8">
                <section class="mail-box-info">
                    <header class="header">
                        <div class="compose-btn pull-left">
                            <a href="{{ url('/person/letter') }}"><button class="btn btn-success btn-sm">我的私信</button></a>
                            <a href="{{ url('/person/sendLetter') }}"><button class="btn btn-default btn-sm ">写私信</button></a>
                        </div>
                        <div class="btn-toolbar">
                            <h4 class="pull-right"></h4>
                        </div>
                    </header>
	                <section class="mail-list">
	                 <div class="panel" >
                          <div class="panel-body">
		               		@foreach($datas as $data)
					                <div class="media blog-cmnt">
					                    <img  style="width:48px;height:48px;" src="{{ $data->avator }}" class="pull-left media-object">
					                    <div class="media-body">
					                        <div style="font-size:14px;">
					                        	@if($data->from_user_id == Auth::id())
					                        		<a class="pull-left" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->from_user_id]) }}">我</a>
					                        	@else
					                        		<a class="pull-left" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->from_user_id]) }}">{{ $data->username }}</a>
					                        	@endif
					                        	<span style="margin:0px 16px;" class="pull-left">回复</span>
					                        	@if($data->to_user_id  ==  Auth::id())
					                        	<a class="pull-left" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->to_user_id]) }}">我</a>
					                        	@else
					                        	<a class="pull-left" href="{{ URL::action('Front\HomeController@index', ['uid'=>$data->to_user_id]) }}">
						                        	 @php echo (UserModel::where('id',$data->to_user_id)->pluck('name'))[0]; @endphp
						                        </a>
					                        	@endif
					                        	 <span class="pull-right">{{ $data->created_at }}</span>
					                        </div>
					                        <div class="bl-status" >{{ $data->content }}</div>
					                    </div>
					                </div>
					      @endforeach()
					     </div>
					      <div class="paginate" style="text-align:center;">{!! $datas->appends(array('to_user'=>$to_user,'from_user_id'=>$from_user_id,'to_user_id'=>$to_user_id))->render() !!}</div>
					 </div>
					     <div class="panel">
                          <div class="panel-body">
                                 <form class="form-horizontal" method="post" action="{{ url('/person/storeLetter') }}" >
			                        	{{ csrf_field() }}
			                        	 <div class="form-group" hidden>
			                                <div class="col-lg-12">
			                                	<input name="from_user_id" value="{{ Auth::id() }}" class="form-control" >
			                                </div>
			                            </div>
			                             <div class="form-group" hidden>
			                                <div class="col-lg-12">
			                                	<input name="to_user_id" value="{{ $to_user }}" class="form-control" >
			                                </div>
			                            </div>
			                            <div class="form-group">
			                                <div class="col-lg-12">
			                                	<textarea rows="4" class="form-control" name="content" placeholder="回复内容"></textarea>
			                                </div>
			                            </div>
			                            <div class="form-group">
			                                <div class="col-lg-offset-10 col-lg-6">
			                                    <button type="submit" class="btn btn-primary">立即发送</button>
			                                </div>
			                            </div>
			                    </form>
                          </div>
                      </div>

	                </section>
                </section>
          </div>

      </div>
  </div>
  <!--body wrapper end-->
</div>
@endsection
