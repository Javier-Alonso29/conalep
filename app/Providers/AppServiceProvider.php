<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Proceso;
use App\Models\Planteles;
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

        view()->composer('*', function ($view) {
            $procesos= Proceso::all();
            $view->with(compact('procesos'));
        });

        view()->composer('*', function ($view) {
            $planteles= Planteles::all();
            $view->with(compact('planteles'));
        });

        view()->composer('*', function ($view) {
            $usuarios= User::where('rol_id',2)->paginate(10);
            $view->with(compact('usuarios'));
        });

    }

}
