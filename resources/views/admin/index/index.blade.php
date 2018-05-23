@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-md-6">
                    {{--服务器环境--}}
                    <div class="ibox float-e-margins">
                        <div class="ibox-content no-padding">
                            <ul class="list-group" style="font-size: 14px;">
                                <li class="list-group-item">
                                    <p><h4>Server Environment</h4></p>
                                </li>
                                <li class="list-group-item">
                                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate('Make me into a QrCode!'); !!}
                                    <p><span >PHP Version：</span>&nbsp;<span class="text-info">{{ $serverEnv['version'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >Server Software：</span>&nbsp;<span class="text-info">{{ $serverEnv['server_software'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >Server OS：</span>&nbsp;<span class="text-info">{{ $serverEnv['server_os'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >Database：</span>&nbsp;<span class="text-info">{{ $serverEnv['database_connection_name'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >SSL Installed：</span>&nbsp;<span class="text-info">{!! $serverEnv['ssl_installed'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >Cache Driver：</span>&nbsp;<span class="text-info">{{ $serverEnv['cache_driver'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >Session Driver：</span>&nbsp;<span class="text-info">{{ $serverEnv['session_driver'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >Openssl Ext：</span>&nbsp;<span class="text-info">{!! $serverEnv['openssl'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >PDO Ext：</span>&nbsp;<span class="text-info">{!! $serverEnv['pdo'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >Mbstring Ext：</span>&nbsp;<span class="text-info">{!! $serverEnv['mbstring'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >Tokenizer Ext：</span>&nbsp;<span class="text-info">{!! $serverEnv['tokenizer']  ? '&#10004;' : '&#10008;'!!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >XML Ext：</span>&nbsp;<span class="text-info">{!! $serverEnv['xml'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                @foreach($serverExtras as $extraStatKey => $extraStatValue)
                                <li class="list-group-item">
                                    <p><span >{{ $extraStatKey }}：</span>&nbsp;<span class="text-info">{{ is_bool($extraStatValue) ? ($extraStatValue ? '&#10004;' : '&#10008;') : $extraStatValue }}</span></p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    {{--Laravel运行环境--}}
                    <div class="ibox float-e-margins">
                        <div class="ibox-content no-padding">
                            <ul class="list-group" style="font-size: 14px;">
                                <li class="list-group-item">
                                    <p><h4>Laravel Environment</h4></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span > Laravel Version：</span>&nbsp;<span class="text-info">{{ $laravelEnv['version'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >Timezone：</span>&nbsp;<span class="text-info">{{ $laravelEnv['timezone'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >Debug Mode：</span>&nbsp;<span class="text-info">{!! $laravelEnv['debug_mode'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >Storage Dir Writable：</span>&nbsp;<span class="text-info">{!! $laravelEnv['storage_dir_writable'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >Cache Dir Writable：</span>&nbsp;<span class="text-info">{!! $laravelEnv['cache_dir_writable'] ? '&#10004;' : '&#10008;' !!}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >Decomposer Version：</span>&nbsp;<span class="text-info">{{ $laravelEnv['decomposer_version'] }}</span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><span >App Size：</span>&nbsp;<span class="text-info">{{ $laravelEnv['app_size'] }}</span></p>
                                </li>
                                @foreach($laravelExtras as $extraStatKey => $extraStatValue)
                                    <li class="list-group-item">
                                        <p><span >{{ $extraStatKey }}：</span>&nbsp;<span class="text-info">{{ is_bool($extraStatValue) ? ($extraStatValue ? '&#10004;' : '&#10008;') : $extraStatValue }}</span></p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content no-padding">
                            <table id="decomposer" class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Package Name : Version</th>
                                    <th>Dependency Name : Version</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($packages as $package)
                                    <tr>
                                        <td>{{ $package['name'] }} : <span class="label ld-version-tag">{{ $package['version'] }}</span></td>
                                        <td>
                                            <ul>
                                                @if(is_array($package['dependencies']))
                                                    @foreach($package['dependencies'] as $dependencyName => $dependencyVersion)
                                                        <li>{{ $dependencyName }} : <span class="label ld-version-tag">{{ $dependencyVersion }}</span></li>
                                                    @endforeach
                                                @else
                                                    <li><span class="label label-primary">{{ $package['dependencies'] }}</span></li>
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection