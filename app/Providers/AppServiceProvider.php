<?php



namespace App\Providers;



use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

use App\User;



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
        Schema::defaultStringLength(191);
        date_default_timezone_set('Asia/Kolkata');
        User::created(function ($user) {
            $user->assignRole('writer');
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

