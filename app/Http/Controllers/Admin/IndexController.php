<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Lubusin\Decomposer\Decomposer;

class IndexController extends Controller
{
    //CMS首页
    public function index()
    {
        $os = [];
        //laravel版本
        $laravel = app();
        $os['laravel_ver'] = $laravel::VERSION;
        //服务器系统当前时间
        $os['current_time'] = time();

        $composerArray = Decomposer::getComposerArray();
        $packages = Decomposer::getPackagesAndDependencies($composerArray['require']);
        $version = Decomposer::getDecomposerVersion($composerArray, $packages);
        $laravelEnv = Decomposer::getLaravelEnv($version);
        $serverEnv = Decomposer::getServerEnv();
        $serverExtras = Decomposer::getServerExtras();
        $laravelExtras = Decomposer::getLaravelExtras();
        $extraStats = Decomposer::getExtraStats();
        return view('admin.index.index', compact('packages', 'laravelEnv', 'serverEnv', 'extraStats', 'serverExtras', 'laravelExtras','os'));

//    	return view('admin.index.index',['os'=>$os]);
    }
}
