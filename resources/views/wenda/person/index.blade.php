@extends('layouts.wenda')
@section('content')
<div class="wrapper">
            @component('wenda.slot.account_show')
             
            @endcomponent
            <div class="col-md-7">
               <h3>最新动态内容</h3>
            </div>
            @component('wenda.slot.account_edit')
             
            @endcomponent
           
</div>
@endsection
