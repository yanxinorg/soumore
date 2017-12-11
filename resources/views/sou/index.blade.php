@extends('layouts.sou_layout')
@section('content')
<style>
.container{
	height:780px;
}
</style>
<div class="container" >
    <h2 class="title" >soumore</h2>
    <div class="col-xs-2"></div>
    <form action="{{ url('/result') }}" method="post" >
    {{ csrf_field() }}
        <div class="col-xs-6">
          <div class="form-group ">
            <input type="text" name="s" class="form-control" />
          </div>
        </div>
        <div class="col-xs-2">
          <div class="form-group">
            <input type="submit" value="搜索" class="form-control" />
          </div>
        </div>
    </form>
    <div class="col-xs-2"></div>
</div>
@endsection
