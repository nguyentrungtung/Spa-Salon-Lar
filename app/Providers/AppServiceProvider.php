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

        view()->composer('layouts.master',function($view){
            $view->with('settings', \App\Setting::settings());
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

