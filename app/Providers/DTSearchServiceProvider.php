<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\DTSearch\DTSearch;


class DTSearchServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->singleton('DTTableMap', function ($app) {
            return new DTTableMap();
        });        
        $this->app->bind('DTSearch', function ($app) {
            return new DTSearch();
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
