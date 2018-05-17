@extends('layouts.admin')
@section('content')
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-sm-8">
                <div class="ibox">
                    <div class="ibox-content">
                        <h2>用户列表</h2>
                        <p>All clients need to be verified before you can send email and set a project.</p>
                        <div class="pull-right ">
                            <div class="dt-buttons btn-group">
                                <a href="{{ url('/back/user/add') }}" class="btn btn-default buttons-csv buttons-html5" tabindex="0" aria-controls="DataTables_Table_0">
                                    <span><i class="fa fa-plus">新增</i></span>
                                </a>
                                <a class="btn btn-default buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_0">
                                    <span>Excel</span>
                                </a>
                                <a class="btn btn-default buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_0">
                                    <span>PDF</span>
                                </a>
                            </div>
                        </div>
                        <div class="input-group col-md-6">
                            <input type="text" placeholder="用户名称，邮箱，角色"  class="input form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                            </span>
                        </div>

                        <div class="clients-list">
                            <ul class="nav nav-tabs">
                                <span class="pull-right small text-muted">1406 Elements</span>
                                <li class="active"><a data-toggle="tab" href="clients.html#tab-1"><i class="fa fa-user"></i> Contacts</a></li>
                                <li class=""><a data-toggle="tab" href="clients.html#tab-2"><i class="fa fa-briefcase"></i> Companies</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                    @foreach($users as $user)
                                                    <tr>
                                                        <td class="client-avatar"><a data-toggle="tab" href="#contact-{{ $user->id }}"><img alt="{{ $user->name }}" src="{{ $user->avator }}"></a> </td>
                                                        <td><a data-toggle="tab" href="#contact-{{ $user->id }}" class="client-link">{{ $user->name }}</a></td>
                                                        <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->created_at }}</td>
                                                        <td class="client-status">
                                                         @if($user->status == 1)<span class="label label-primary">Active</span>@else<span class="label label-danger">Disabled</span>@endif
                                                        </td>
                                                        <td class="text-right footable-visible footable-last-column">
                                                            <div class="btn-group">
                                                                <a class="btn btn-white" href="{{ URL::action('Admin\UserController@edit', ['id'=>$user->id]) }}"><i class="fa fa-edit"></i></a>
                                                                <a class="btn btn-white " href="javascript:void(0);" onclick="del({{ $user->id }});"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach()
                                                </tbody>

                                            </table>
                                            <div class="clearfix pull-right">{{ $users->links() }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr>
                                                    <td><a data-toggle="tab" href="clients.html#company-1" class="client-link">Tellus Institute</a></td>
                                                    <td>Rexton</td>
                                                    <td><i class="fa fa-flag"></i> Angola</td>
                                                    <td class="client-status"><span class="label label-primary">Active</span></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="tab-content">
                            @foreach($users as $user)
                            <div id="contact-{{ $user->id }}" class="tab-pane">
                                <div class="row m-b-lg">
                                    <div class="col-lg-4 text-center">
                                        <h2>{{ $user->name }}</h2>
                                        <div class="m-b-sm">
                                            <img alt="image" class="img-circle" src="{{ $user->avator }}"style="width: 62px;height: 62px;">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <strong>自我介绍</strong>
                                        <p>{{ $user->bio }}</p>
                                        <button type="button" class="btn btn-primary btn-sm btn-block">
                                            <i class="fa fa-envelope"></i> Send Message
                                        </button>
                                    </div>
                                </div>
                                <div class="client-detail">
                                    <div class="full-height-scroll">
                                        <strong style="font-size: 18px;">活动记录</strong>
                                        <ul class="list-group clear-list">
                                            <li class="list-group-item fist-item">
                                                <span class="pull-right">{{ $user->latest_login_time }}</span>最近登录时间
                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right">{{ $user->latest_logout_time }}</span>最近登出时间
                                            </li>
                                            <li class="list-group-item">
                                                <span class="pull-right">{{ $user->latest_login_ip }}</span>最近登录IP
                                            </li>
                                        </ul>
                                        <strong>Notes</strong>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua.
                                        </p>
                                        <hr/>
                                        <strong>Timeline activity</strong>
                                        <div id="vertical-timeline" class="vertical-container dark-timeline">
                                            <div class="vertical-timeline-block">
                                                <div class="vertical-timeline-icon gray-bg">
                                                    <i class="fa fa-coffee"></i>
                                                </div>
                                                <div class="vertical-timeline-content">
                                                    <p>Conference on the sales results for the previous year.
                                                    </p>
                                                    <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-block">
                                                <div class="vertical-timeline-icon gray-bg">
                                                    <i class="fa fa-briefcase"></i>
                                                </div>
                                                <div class="vertical-timeline-content">
                                                    <p>Many desktop publishing packages and web page editors now use Lorem.
                                                    </p>
                                                    <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-block">
                                                <div class="vertical-timeline-icon gray-bg">
                                                    <i class="fa fa-bolt"></i>
                                                </div>
                                                <div class="vertical-timeline-content">
                                                    <p>There are many variations of passages of Lorem Ipsum available.
                                                    </p>
                                                    <span class="vertical-date small text-muted"> 06:10 pm - 11.03.2014 </span>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-block">
                                                <div class="vertical-timeline-icon navy-bg">
                                                    <i class="fa fa-warning"></i>
                                                </div>
                                                <div class="vertical-timeline-content">
                                                    <p>The generated Lorem Ipsum is therefore.
                                                    </p>
                                                    <span class="vertical-date small text-muted"> 02:50 pm - 03.10.2014 </span>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-block">
                                                <div class="vertical-timeline-icon gray-bg">
                                                    <i class="fa fa-coffee"></i>
                                                </div>
                                                <div class="vertical-timeline-content">
                                                    <p>Conference on the sales results for the previous year.
                                                    </p>
                                                    <span class="vertical-date small text-muted"> 2:10 pm - 12.06.2014 </span>
                                                </div>
                                            </div>
                                            <div class="vertical-timeline-block">
                                                <div class="vertical-timeline-icon gray-bg">
                                                    <i class="fa fa-briefcase"></i>
                                                </div>
                                                <div class="vertical-timeline-content">
                                                    <p>Many desktop publishing packages and web page editors now use Lorem.
                                                    </p>
                                                    <span class="vertical-date small text-muted"> 4:20 pm - 10.05.2014 </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach()
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
