<?php

namespace App\Providers;

use App\Library\Flutterwave;
use Illuminate\Support\ServiceProvider;

class FlutterwaveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('flutterwave',function(){
            return new Flutterwave();
        });
    }
}
