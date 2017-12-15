<style>
.col-md-12{
	background-color:white;
}
img{
width:100%;
}
</style>
<div class="notice" >
    <div class="col-md-12 col-sm-12" >
    <h6 style="text-align: center;color: red;">{{ $notice->title }}</h6>
        {!! $notice->content !!}
    </div>
</div>