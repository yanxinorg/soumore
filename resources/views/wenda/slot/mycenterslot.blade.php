<style>
.col-md-12{
	background-color:white;
}
</style>
@if(Auth::check())
<div class="write" >
    <a href="{{ url('/post/create') }}"  class="btn btn-block btn-default">写文章</a>
</div>
<div class="person" >
    <div class="col-md-12 col-sm-12" style="margin-bottom:12px;">
	    <ul class="nav" style="margin: 4px;text-align:center;">
			<li><a href="{{ url('/person/post') }}">我的文章</a></li>
			<li><a href="{{ url('/person/answer') }}">我的问答</a></li>
			<li><a href="{{ url('/person/collect') }}">我的收藏</a></li>
			<li><a href="{{ url('/person/attention') }}">我的关注</a></li>
			<li><a href="{{ url('/person/letter') }}">我的私信</a></li>
		</ul>
    </div>
</div>
@endif