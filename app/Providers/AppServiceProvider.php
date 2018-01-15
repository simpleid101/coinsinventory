<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \Cloudinary::config(array( 
            "cloud_name" => env('CLOUDINARY_CLOUD_NAME'),  
            "api_key" => env('CLOUDINARY_API_KEY'), 
            "api_secret" => env('CLOUDINARY_API_SECRET') 
        ));
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
