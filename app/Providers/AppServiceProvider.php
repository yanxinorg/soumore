<?php

namespace App\Providers;

use App\Models\Common\MessageModel;
use App\Models\Common\UserModel;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    	Schema::defaultStringLength(191);
    	\Carbon\Carbon::setLocale('zh');
        view()->composer('layouts/ask', function ($view) {
            $userInfo = UserModel::where('id',Auth::id())->pluck('avator')?UserModel::where('id',Auth::id())->pluck('avator'):'';
            $countNotice = MessageModel::where([
                'to_user_id'=>Auth::id(),
                'is_read'=>null
            ])->count();
            $view->with([
                'thumb'=>$userInfo,
                'countNotice'=>$countNotice
            ]);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
