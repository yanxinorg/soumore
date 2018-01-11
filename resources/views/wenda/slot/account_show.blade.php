<style>
.profile-pic span{
	font-size:128px;
	line-height:128px;
	text-align:center;
}
.panel .panel-body .p-info{
	font-size:12px;
	overflow:hidden;
}
</style>
<?php 
use App\Models\Common\AreaModel;
?>
<div class="col-md-3 col-sm-3">
                 <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                	@if(!empty($userinfo->avator))
                                    <div class="profile-pic text-center">
                                        <img src="{{ route('getThumbImg', Auth::id()) }}">
                                    </div>
                                    @else
                                     <div class="profile-pic text-center">
                                        <span>☯</span>   
                                     </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <ul class="p-info">
                                    	@if(!empty($userinfo->name))
                                    	<li>
                                            <div class="title">用户名</div>
                                            <div class="desk">{{ $userinfo->name }}</div>
                                        </li>
                                       	@endif
                                       	@if(!empty($userinfo->realname))
                                        <li>
                                            <div class="title">真实姓名</div>
                                            <div class="desk">{{ $userinfo->realname }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->email))
                                        <li>
                                            <div class="title">邮箱</div>
                                            <div class="desk">{{ $userinfo->email }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->created_at))
                                        <li>
                                            <div class="title">注册时间</div>
                                            <div class="desk">{{ substr($userinfo->created_at,0,10) }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->mobile))
                                        <li>
                                            <div class="title">手机号</div>
                                            <div class="desk">{{ $userinfo->mobile }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->birthday))
                                        <li>
                                            <div class="title">生日</div>
                                            <div class="desk">{{ $userinfo->birthday }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->site))
                                        <li>
                                            <div class="title">个人主页</div>
                                            <div class="desk"><a href="{{ $userinfo->site }}" target="_blank" >{{ $userinfo->site }}</a></div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->qq))
                                        <li>
                                            <div class="title">QQ</div>
                                            <div class="desk">{{ $userinfo->qq }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->weixin))
                                        <li>
                                            <div class="title">微信</div>
                                            <div class="desk">{{ $userinfo->weixin }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->graduateschool))
                                        <li>
                                            <div class="title">毕业院校</div>
                                            <div class="desk">{{ $userinfo->graduateschool }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->province))
                                        <li>
                                            <div class="title">所在城市</div>
                                            <div class="desk">
                                            @php echo (AreaModel::where('id',$userinfo->province)->pluck('name'))[0]; @endphp,
                                            @php echo (AreaModel::where('id',$userinfo->city)->pluck('name'))[0]; @endphp市
                                            </div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->company))
                                        <li>
                                            <div class="title">公司名称</div>
                                            <div class="desk">{{ $userinfo->company }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->occupation))
                                        <li>
                                            <div class="title">职业</div>
                                            <div class="desk">{{ $userinfo->occupation }}</div>
                                        </li>
                                        @endif
                                        @if(!empty($userinfo->bio))
                                        <li>
                                            <div class="title">个性签名</div>
                                            <div class="desk">{{ $userinfo->bio }}</div>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
</div>