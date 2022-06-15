<?php

namespace App\Providers;

use App\View\Components\Alert;
use App\View\Components\Inputs;
use App\View\Components\Inputs\Button;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        //



        // package-alert : tên đăng ký 
        Blade::component('package-alert', Alert::class);
        // Blade::component('button', Button::class);
    }
}
