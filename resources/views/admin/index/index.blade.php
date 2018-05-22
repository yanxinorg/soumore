@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content">
            <div class="row">
                {{--服务器环境--}}
                <div class="col-md-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content no-padding">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <p><h4>Server Environment</h4></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >PHP Version：</span>&nbsp;<span class="text-info">{{ $serverEnv['version'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Server Software：</span>&nbsp;<span class="text-info">{{ $serverEnv['server_software'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Server OS：</span>&nbsp;<span class="text-info">{{ $serverEnv['server_os'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Database：</span>&nbsp;<span class="text-info">{{ $serverEnv['database_connection_name'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >SSL Installed：</span>&nbsp;<span class="text-info">{!! $serverEnv['ssl_installed'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Cache Driver：</span>&nbsp;<span class="text-info">{{ $serverEnv['cache_driver'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Session Driver：</span>&nbsp;<span class="text-info">{{ $serverEnv['session_driver'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Openssl Ext：</span>&nbsp;<span class="text-info">{!! $serverEnv['openssl'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >PDO Ext：</span>&nbsp;<span class="text-info">{!! $serverEnv['pdo'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Mbstring Ext：</span>&nbsp;<span class="text-info">{!! $serverEnv['mbstring'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>

                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Tokenizer Ext：</span>&nbsp;<span class="text-info">{!! $serverEnv['tokenizer']  ? '&#10004;' : '&#10008;'!!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >XML Ext：</span>&nbsp;<span class="text-info">{!! $serverEnv['xml'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                @foreach($serverExtras as $extraStatKey => $extraStatValue)
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >{{ $extraStatKey }}：</span>&nbsp;<span class="text-info">{{ is_bool($extraStatValue) ? ($extraStatValue ? '&#10004;' : '&#10008;') : $extraStatValue }}</span></p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                {{--Laravel运行环境--}}
                <div class="col-md-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content no-padding">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <p><h4>Laravel Environment</h4></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span > Laravel Version：</span>&nbsp;<span class="text-info">{{ $laravelEnv['version'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Timezone：</span>&nbsp;<span class="text-info">{{ $laravelEnv['timezone'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Debug Mode：</span>&nbsp;<span class="text-info">{!! $laravelEnv['debug_mode'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Storage Dir Writable：</span>&nbsp;<span class="text-info">{!! $laravelEnv['storage_dir_writable'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Cache Dir Writable：</span>&nbsp;<span class="text-info">{!! $laravelEnv['cache_dir_writable'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >Decomposer Version：</span>&nbsp;<span class="text-info">{{ $laravelEnv['decomposer_version'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >App Size：</span>&nbsp;<span class="text-info">{{ $laravelEnv['app_size'] }}</span></p>
                                </li>
                                @foreach($laravelExtras as $extraStatKey => $extraStatValue)
                                <li class="list-group-item">
                                    <p style="font-size:16px;"><span >{{ $extraStatKey }}：</span>&nbsp;<span class="text-info">{{ is_bool($extraStatValue) ? ($extraStatValue ? '&#10004;' : '&#10008;') : $extraStatValue }}</span></p>
                                </li>
                                @endforeach
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
                                    <p><h4>Installed Packages and their Dependencies</h4></p>
                                </li>
                                @foreach($packages as $package)
                                    <li class="list-group-item">
                                        <p style="font-size:16px;"><span >{{ $package['name'] }}：</span>&nbsp;<span class="text-info">{{ $package['version'] }}</span></p>
                                    </li>
                                    @if(is_array($package['dependencies']))
                                        @foreach($package['dependencies'] as $dependencyName => $dependencyVersion)
                                            <li class="list-group-item">
                                                <p style="font-size:16px;"><span >{{ $dependencyName }}：</span>&nbsp;<span class="text-info">{{ $dependencyVersion }}</span></p>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item">
                                            <p style="font-size:16px;"><span ></span>&nbsp;<span class="text-info">{{ $package['dependencies'] }}</span></p>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection