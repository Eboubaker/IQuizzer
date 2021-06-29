<?php

namespace App\Providers;

use App\Models\Quiz;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
        Quiz::observe(QuizServiceProvider::class);
        Blade::include('includes.input', 'input');
        Blade::include('includes.forminput', 'forminput');
        $this->app->bind("UserConversionUnit", function(){
            return Auth::user()->settings->pointsConversionUnit ?? config('app.conversionUnit');
        });
    }
}
