@extends('layouts.wenda')
@section('content')
<style>
.mail-list{
	height:auto;
}
.blog-img-sm{
	text-align: center;
}

.panel .panel-body .auth-row{
	font-size: 12px;
	margin-bottom:4px;
}
.panel .panel-body .auth-row span{
	display:inline-block;
	margin:0px 8px;
}

.panel .panel-body .detail{
	font-size: 16px;
	color:#1ABC9C;
	float:right;
}
.container-fluid{
	border-bottom:1px solid #D1D5E1;
	margin:12px 0px;
}
.container-fluid .row-fluid .media{
	margin-bottom: 12px;
}
.container-fluid .row-fluid .media img{
	width:96px;
}
.container-fluid .row-fluid .media-body .content{
	display:block;
	font-size: 14px;
}
.container-fluid .row-fluid .media-body .content h6{
	font-size:14px;
	display:inline-block;
	margin-left:80px;
}
.container-fluid .row-fluid .media-body .content span{
	 margin-left:24px;
}
.container-fluid .row-fluid .media-body .excerpt{
	font-size:12px;
	margin-left:24px;
	margin-top:6px;
}
</style>
<link href="{{ asset('wenda/select/css/bootstrap-select.min.css') }}" rel="stylesheet">
<div class="main-content">
  <div class="wrapper">
      <div class="directory-info-row">
          <div class="col-md-10 col-sm-9">
                <section class="mail-box-info">
                    <header class="header">
                        <div class="compose-btn pull-left">
                            <a href="{{ url('/person/letter') }}"><button class="btn btn-default btn-sm">我的私信</button></a>
                            <a href="{{ url('/person/sendLetter') }}"><button class="btn btn-success btn-sm ">写私信</button></a>
                        </div>
                        <div class="btn-toolbar">
                            <h4 class="pull-right"></h4>
                        </div>
                    </header>
	                <section class="mail-list">
                        <div class="panel">
                          <div class="panel-body">
                                 <form class="form-horizontal" method="post" action="{{ url('/person/storeLetter') }}" >
			                        	{{ csrf_field() }}
			                        	 <div class="form-group" hidden>
			                                <div class="col-lg-12">
			                                	<input name="from_user_id" value="{{ Auth::id() }}" class="form-control" >
			                                </div>
			                            </div>
									    <div class="form-group">
									      <div class="col-lg-6">
									         <select id="lunch" class="selectpicker" data-live-search="true" name="to_user_id" title="请选择用户...">
									         	@foreach($users as $user)
										        <option value="{{ $user->id }}">{{ $user->name }}</option>
										        @endforeach()
										      </select>
									      </div>
									    </div>
			                            <div class="form-group">
			                                <div class="col-lg-12">
			                                	<textarea rows="4" class="form-control" name="content" placeholder="私信内容"></textarea>
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
          <div class="col-md-2 col-sm-3" >
             @component('wenda.slot.mycenterslot')
             @endcomponent
          </div>
      </div>
  </div>
  <!--body wrapper end-->
</div>
@section('js')
@parent
<!-- tags插件 -->
<script type="text/javascript" src="{{ URL::asset('wenda/select/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript">
jQuery(function(){
	//select选择
	 var mySelect = $('#first-disabled2');
	    $('#special').on('click', function () {
	      mySelect.find('option:selected').prop('disabled', true);
	      mySelect.selectpicker('refresh');
	    });
	    $('#special2').on('click', function () {
	      mySelect.find('option:disabled').prop('disabled', false);
	      mySelect.selectpicker('refresh');
	    });
	    $('#basic2').selectpicker({
	      liveSearch: true,
	      maxOptions: 1
	    });
});
</script>
@stop
@endsection

