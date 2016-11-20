<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Kiểm tra số điện thoại
        Validator::extend('phone', function($attribute, $value, $parameters, $validator){
            $pattern = '/^(09[0-9]{8})|(01[0-9]{9})$/';            
            return preg_match($pattern, $value);
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