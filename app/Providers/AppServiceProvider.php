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
                    'merchantId' => 'ncsdg6z273zwz2h4',
                    'publicKey' => 'sm5brq2cvf849z82',
                    'privateKey' => 'ad8b0a347709b5f2a541f6f4ef0ec386'
                ]
            );
        });
    }
}
