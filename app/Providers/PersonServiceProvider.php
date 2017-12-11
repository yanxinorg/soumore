<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class PersonServiceProvider extends ServiceProvider
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
    			'wenda.slot.*', 'App\Http\Controllers\Common\PersonController'
    			);
    }
	
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
