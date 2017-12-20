<style>
.col-md-12{
	background-color:white;
}
.notice h6 > img{
width:100%;
}
</style>
<div class="notice" >
    <div class="col-md-12 col-sm-12 notice" >
    <h6 style="text-align: center;color: red;">{{ $notice->title }}</h6>
        {!! $notice->content !!}
    </div>
</div>