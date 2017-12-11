<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // 基于类的view composer
    	View::composer(
    			'wenda.slot.*', 'App\Http\Controllers\Common\PostController'
    			);
    }

    public function register()
    {
        //
    }
}
