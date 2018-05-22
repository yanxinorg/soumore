@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content no-padding">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <p><h4>基础环境</h4></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Php版本：</span>&nbsp;<span class="text-info"><?php echo PHP_VERSION; ?> </span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Laravel版本：</span>&nbsp;<span class="text-info">{{ $os['laravel_ver'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >服务器操作系统：</span>&nbsp;<span class="text-info"><?php echo PHP_OS; ?></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >服务器端信息：</span>&nbsp;<span class="text-info"><?php echo $_SERVER ['SERVER_SOFTWARE']; ?></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >最大上传限制：</span>&nbsp;<span class="text-info"><?PHP echo get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传附件"; ?></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >最大执行时间：</span>&nbsp;<span class="text-info"><?PHP echo get_cfg_var("max_execution_time")."秒 "; ?></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Mysql数据库的版本：</span>&nbsp;<span class="text-info"></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >MySQL最大连接数：</span>&nbsp;<span class="text-info"><?php echo @get_cfg_var("mysql.max_links")==-1 ? "不限" :@get_cfg_var("mysql.max_links");?></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >脚本运行占用最大内存：</span>&nbsp;<span class="text-info"><?php echo get_cfg_var ("memory_limit")?get_cfg_var("memory_limit"):"无" ?></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >服务器系统时间：</span>&nbsp;<span class="text-info">{{ date("Y-m-d G:i:s",$os['current_time']) }}</span></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content no-padding">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <p><h4>运行环境</h4></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Php版本：</span>&nbsp;<span class="text-info"><?php echo PHP_VERSION; ?> </span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Laravel版本：</span>&nbsp;<span class="text-info">{{ $os['laravel_ver'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >服务器操作系统：</span>&nbsp;<span class="text-info"><?php echo PHP_OS; ?></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >服务器端信息：</span>&nbsp;<span class="text-info"><?php echo $_SERVER ['SERVER_SOFTWARE']; ?></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >最大上传限制：</span>&nbsp;<span class="text-info"><?PHP echo get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传附件"; ?></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >最大执行时间：</span>&nbsp;<span class="text-info"><?PHP echo get_cfg_var("max_execution_time")."秒 "; ?></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >MYSQL数据库的版本：</span>&nbsp;<span class="text-info"></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >脚本运行占用最大内存：</span>&nbsp;<span class="text-info"><?PHP echo get_cfg_var ("memory_limit")?get_cfg_var("memory_limit"):"无" ?></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >服务器系统时间：</span>&nbsp;<span class="text-info">{{ date("Y-m-d G:i:s",$os['current_time']) }}</span></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection