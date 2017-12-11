<style>
.col-md-12{
	background-color:white;
}

</style>
<div class="hot" style="display: inline-block;">
     <div class="col-md-12 col-sm-12" >
     		<h6 style="text-align: center;">猜你喜欢</h6>
            @foreach($hots as $hot)
                <a href="{{ URL::action('Front\PostController@detail', ['id'=>$hot->id]) }}" style="font-size: 16px;display:block;margin:4px 0px;" >{{ str_limit($hot->title,76) }}</a>
            @endforeach()
     </div>
</div>