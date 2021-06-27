<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
// use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $user = User::find(Auth::id())->unreadNotifications;
        // dd(Auth::user());
    }
}
