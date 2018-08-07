@extends('layouts.ask')
@section('content')
<?php
use App\Models\Common\AttentionModel;
?>
    <div class="aw-container-wrap">
        <div class="container1">
            <div class="row">
                <div class="aw-content-wrap clearfix">
                    <div class="col-sm-12 col-md-9 aw-main-content">
                        <div class="aw-mod">
                            <div class="mod-head common-head">
                                <h2><i class="icon icon-users"></i>人气用户</h2>
                            </div>
                            <div class="mod-body aw-people-list">
                                @foreach($users as $user)
                                <div class="aw-item">
                                    <span class="aw-user-sort-count aw-border-radius-5 active"><i class="icon icon-flag"></i> <em>1</em></span>
                                    <a class="aw-user-img aw-border-radius-5" href="{{ URL::action('Front\HomeController@index', ['uid'=>$user->id]) }}">
                                        <img style="width:50px;" src="{{ $user->avator }}-sm_thumb_middle">
                                    </a>
                                    <p class="text-color-999 title">
                                        <a href="{{ URL::action('Front\HomeController@index', ['uid'=>$user->id]) }}" class="aw-user-name">{{ $user->name  }}</a>
                                    </p>
                                    <p class="text-color-999 signature"></p>
                                    <div class="meta">
                                        <span><i class="icon icon-prestige"></i>金币 <b>0</b></span>
                                        <span><i class="icon icon-agree"></i>经验 <b>0</b></span>
                                    </div>

                                   {{--关注用户--}}
                                    @if(!empty(Auth::id()))
                                        {{--登录用户--}}
                                        @if( AttentionModel::where(['user_id'=>Auth::id(),'source_id'=>$user->id,'source_type'=>'1'])->exists())
                                            <div class="operate">
                                                <a class="follow btn btn-normal btn-success active" href="{{ URL::action('Front\AttentionController@cancelUser', ['uid'=>$user->id]) }}">取消关注</a>
                                            </div>
                                        @else
                                            @if(Auth::id() !== $user->id )
                                                <div class="operate">
                                                    <a class="follow btn btn-normal btn-success" href="{{ URL::action('Front\AttentionController@user', ['uid'=>$user->id]) }}">关注</a>
                                                </div>
                                            @endif
                                        @endif
                                    @else
                                        {{--没有登录--}}
                                        <div class="operate">
                                            <a href="{{ URL::action('Front\AttentionController@user', ['uid'=>$user->id]) }}"  class="follow btn btn-normal btn-success"><span>关注</span></a>
                                        </div>
                                    @endif
                                </div>
                                @endforeach()
                                 <div class="paginate" style="text-align:center;">{{ $users->links() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm active">
                        <div class="aw-mod side-nav">
                            <div class="mod-body">
                                <ul>
                                </ul>
                            </div>
                        </div>

                        <div class="aw-mod side-nav">
                            <div class="mod-body">
                                <ul>
                                </ul>
                            </div>
                        </div>

                        <!-- <div class="aw-mod people-sort">
                            <div class="mod-body">
                                <input type="text" name="" placeholder="按擅长话题搜索..." class="form-control" />
                                <i class="icon icon-down"></i>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection