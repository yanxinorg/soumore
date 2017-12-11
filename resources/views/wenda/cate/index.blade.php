@extends('layouts.wenda')
@section('content')
<style>
.mail-list{
	height:auto;
}
.nav_tabs{
	background-color:white;
}
.nav_tabs li:last-child{
	padding-bottom:12px;
}
</style>
<div class="main-content">
  <div class="wrapper">
      <div class="directory-info-row">
	      <div class="col-md-2 col-sm-2" >
		       <div class="category">
					<div class="col-md-12 col-sm-12" >
						<ul class="nav nav_tabs " >
						<h6 style="text-align: center;">分类</h6>
							@foreach($cates as $cate)
							@if($cate->id == $cateid )
							<li style="font-size: 16px; text-align:center; background-color:#EEEEEE;margin:4px 0px;" >
								<a href="{{ URL::action('Front\CategoryController@index', ['cateid'=>$cate->id]) }}">{{ $cate->name }}</a>
							</li>
							@else
							<li style="font-size: 16px; text-align:center;margin:4px 0px;" >
								<a href="{{ URL::action('Front\CategoryController@index', ['cateid'=>$cate->id]) }}">{{ $cate->name }}</a>
							</li>
							@endif
							@endforeach()
						</ul>
					</div>
				</div>
	      </div>
          <div class="col-md-8 col-sm-8">
                <section class="mail-box-info">
                    <header class="header">
                        <div class="compose-btn pull-left">
                            <a href="{{ URL::action('Front\CategoryController@index', ['cateid'=>$cateid]) }}"><button class="btn btn-success btn-sm">最新问答</button></a>
                            <a href="{{ URL::action('Front\CategoryController@article', ['cateid'=>$cateid]) }}"><button class="btn btn-sm btn-default">文章</button></a>
                            <a href="{{ URL::action('Front\CategoryController@answer', ['cateid'=>$cateid]) }}"><button class="btn btn-sm btn-default">问答</button></a>
                        </div>
                        <div class="btn-toolbar">
                            <h4 class="pull-right"></h4>
                        </div>
                    </header>
	                <section class="mail-list">
                        <ul class="list-group ">
                            <li class="list-group-item">
                                <a class="thumb pull-left" href="#"> <img src="images/avatar-mini.jpg"> </a>
                                <a class="" href="mail_view.html"> <small class="pull-right text-muted">15 April</small> <strong>John Doe</strong>  <span>Donec ultrices faucibus rutrum. Phasellus sodales </span> <span class="label label-sm btn-success">normal</span> </a>
                            </li>
                            <li class="list-group-item">
                                <a class="thumb pull-left" href="#"> <img src="images/photos/user1.png"> </a>
                                <a class="" href="mail_view.html"> <small class="pull-right text-muted">10 May</small> <strong>Jane Doe</strong> <span>Phasellus sodales vulputate urna, vel accumsan augue egestas ac  </span> <span class="label label-sm btn-danger">urgent</span> </a>
                            </li>
                            <li class="list-group-item">
                                <a class="thumb pull-left" href="#"> <img src="images/photos/user2.png"> </a>
                                <a class="" href="mail_view.html"> <small class="pull-right text-muted">3 June</small> <strong>Jonathan Smith</strong>  <span>Porttitor eu consequat risus. </span> <span class="label label-sm btn-warning">error</span> </a>
                            </li>
                            <li class="list-group-item">
                                <a class="thumb pull-left" href="#"> <img src="images/photos/user3.png"> </a>
                                <a class="" href="mail_view.html"> <small class="pull-right text-muted">15 April</small> <strong>John Doe</strong>  <span>Donec ultrices faucibus rutrum. Phasellus sodales </span>  </a>
                            </li>
                            <li class="list-group-item">
                                <a class="thumb pull-left" href="#"> <img src="images/photos/user4.png"> </a>
                                <a class="" href="mail_view.html"> <small class="pull-right text-muted">10 May</small> <strong>Jane Doe</strong> <span>Phasellus sodales vulputate urna, vel accumsan augue egestas ac  </span> </a>
                            </li>
                            <li class="list-group-item">
                                <a class="thumb pull-left" href="#"> <img src="images/photos/user1.png"> </a>
                                <a class="" href="mail_view.html"> <small class="pull-right text-muted">3 June</small> <strong>Jonathan Smith</strong>  <span>Porttitor eu consequat risus. </span> <span class="label label-sm btn-warning">error</span> </a>
                            </li>
                            <li class="list-group-item">
                                <a class="thumb pull-left" href="#"> <img src="images/photos/user5.png"> </a>
                                <a class="" href="mail_view.html"> <small class="pull-right text-muted">15 April</small> <strong>John Doe</strong>  <span>Donec ultrices faucibus rutrum. Phasellus sodales </span>  </a>
                            </li>
                            <li class="list-group-item">
                                <a class="thumb pull-left" href="#"> <img src="images/photos/user1.png"> </a>
                                <a class="" href="mail_view.html"> <small class="pull-right text-muted">10 May</small> <strong>Jane Doe</strong> <span>Phasellus sodales vulputate urna, vel accumsan augue egestas ac   </a>
                            </li>
                            <li class="list-group-item">
                                <a class="thumb pull-left" href="#"> <img src="images/avatar-mini.jpg"> </a>
                                <a class="" href="mail_view.html"> <small class="pull-right text-muted">3 June</small> <strong>Jonathan Smith</strong>  <span>Porttitor eu consequat risus.  </a>
                            </li>
                            <li class="list-group-item">
                                <a class="thumb pull-left" href="#"> <img src="images/photos/user3.png"> </a>
                                <a class="" href="mail_view.html"> <small class="pull-right text-muted">15 April</small> <strong>John Doe</strong>  <span>Donec ultrices faucibus rutrum. Phasellus sodales </span> <span class="label label-sm btn-success">normal</span> </a>
                            </li>
                            <li class="list-group-item">
                                <a class="thumb pull-left" href="#"> <img src="images/photos/user4.png"> </a>
                                <a class="" href="mail_view.html"> <small class="pull-right text-muted">10 May</small> <strong>Jane Doe</strong> <span>Phasellus sodales vulputate urna, vel accumsan augue egestas ac  </span> <span class="label label-sm btn-danger">urgent</span> </a>
                            </li>
                            <li class="list-group-item">
                                <a class="thumb pull-left" href="#"> <img src="images/photos/user2.png"> </a>
                                <a class="" href="mail_view.html"> <small class="pull-right text-muted">3 June</small> <strong>Jonathan Smith</strong>  <span>Porttitor eu consequat risus. </a>
                            </li>
                            <li class="list-group-item">
                                <a class="thumb pull-left" href="#"> <img src="images/avatar-mini.jpg"> </a>
                                <a class="" href="mail_view.html"> <small class="pull-right text-muted">15 April</small> <strong>John Doe</strong>  <span>Donec ultrices faucibus rutrum. Phasellus sodales </span>  </a>
                            </li>
                        </ul>
                    </section>
                </section>
          	<div class="paginate" style="text-align:center;"></div>
          </div>
          <div class="col-md-2 col-sm-2" >
             @component('wenda.slot.mycenterslot')
             @endcomponent
          </div>
      </div>
  </div>
  <!--body wrapper end-->
</div>
<!-- main content end-->

@endsection
