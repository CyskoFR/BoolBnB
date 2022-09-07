<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

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
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'zzxjcmq28h44dvzm',
                    'publicKey' => 'fm2qrn92mddpzd3b',
                    'privateKey' => 'cf9731a133ef6c90acf2814fa237e6b4'
                ]
            );
        });
    }
}
