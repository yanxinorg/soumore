<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    	//QQ社会化监听器
    	'SocialiteProviders\Manager\SocialiteWasCalled' => [
    		'SocialiteProviders\Qq\QqExtendSocialite@handle',
    	],
    	//微博社会化监听
    	'SocialiteProviders\Manager\SocialiteWasCalled' => [
    		'SocialiteProviders\Weibo\WeiboExtendSocialite@handle',
    	],
    	//微信社会化监听
    	 SocialiteWasCalled::class => [        
        \SocialiteProviders\Weixin\WeixinExtendSocialite::class,    
    	],
    		
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
