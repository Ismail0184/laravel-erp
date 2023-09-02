<?php

namespace App\Providers;

use App\Models\Accounts\AccTransactions;
use App\Models\Developer\DevMainMenu;
use Illuminate\Support\ServiceProvider;
use View;
use Session;
use Blade;

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
        \Session::put('module_id', 'module_id');
        View::composer(['layouts.app'], function ($view) {
            $view->with('mainmenus', DevMainMenu::where('status','1')->where('module_id',\Session::get('module_id', 'module_id'))->orderBy('serial','ASC')->get());
        });
    }
}
