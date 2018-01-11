@extends('layouts.wenda')
@section('content')
        <div class="wrapper">
         <div class="directory-info-row">
            @component('wenda.slot.account_show')
            @endcomponent
            <div class="col-md-9 col-sm-9">
                <section class="mail-box-info">
                    <header class="header">
                        <div class="compose-btn pull-left">
                            <a href="{{ url('/person/info') }}"><button class="btn btn-default btn-sm">个人资料</button></a>
                            <a href="{{ url('/person/thumb') }}"><button class="btn btn-sm btn-default">修改头像</button></a>
                            <a href="{{ url('/person/pass') }}"><button class="btn btn-sm btn-success">修改密码</button></a>
                        </div>
                        <div class="btn-toolbar">
                            <h4 class="pull-right"></h4>
                        </div>
                    </header>
	                <section class="mail-list" >
	                        <form class="form-horizontal" method="POST" action="{{ url('/person/storepass') }}">
	                        @if ($errors->has('success'))
	                           <div class="form-group">
	                                <div class="col-md-12 col-sm-12">
								        <div class="alert alert-success ">
								            {{ $errors->first('success') }}
								        </div>
	                                </div>
	                            </div>
	                        @endif
	                        {{ csrf_field() }}
	                            <div class="form-group">
	                                <label  class="col-md-2 col-sm-2 control-label">原密码</label>
	                                <div class="col-md-6 col-sm-6">
	                                    <input type="text" name="old_password" value="{{ old('old_password') }}" class="form-control"  placeholder="原密码">
	                                </div>
	                                <div class="col-md-4 col-sm-4">
		                                 @if ($errors->has('old_password'))
								            <div class="alert-danger ">
								                 {{ $errors->first('old_password') }}
								            </div>
								         @endif
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label  class="col-md-2 col-sm-2 control-label">新密码</label>
	                                <div class="col-md-6 col-sm-6">
	                                    <input type="password" name="new_password" value="{{ old('new_password') }}" class="form-control" placeholder="新密码">
	                                </div>
	                                <div class="col-md-4 col-sm-4">
		                                 @if ($errors->has('new_password'))
								            <div class="alert-danger ">
								                 {{ $errors->first('new_password') }}
								            </div>
								         @endif
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <label  class="col-md-2 col-sm-2 control-label">确认密码</label>
	                                <div class="col-md-6 col-sm-6">
	                                    <input type="password" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}"  class="form-control" placeholder="确认密码">
	                                </div>
	                                <div class="col-md-4 col-sm-4">
		                                 @if ($errors->has('new_password_confirmation'))
								            <div class="alert-danger ">
								                 {{ $errors->first('new_password_confirmation') }}
								            </div>
								         @endif
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <div class="col-lg-offset-2 col-sm-offset-2 col-md-6 col-sm-6">
	                                    <button type="submit" class="btn btn-primary">修改</button>
	                                </div>
	                            </div>
	                        </form>
	                </section>
                </section>
            </div>
           <div class="col-md-2">
           
           </div>
         </div>
        </div>
@endsection
