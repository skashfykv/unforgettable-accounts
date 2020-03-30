<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use App\User;

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
        Schema::defaultStringLength(191);
        Validator::extend('password_rules', function ($attribute, $value) {
            return preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[a-zA-Z])(?=.*[0-9])(?=.*\W).*$#", $value);
        });
        Validator::extend('is_login_validator', function ($attribute, $value, $parameters, $validator) {
           if(user::where('is_login',1)->count() == 1){
                return false;
           }
           return true;
        });
    }
}
