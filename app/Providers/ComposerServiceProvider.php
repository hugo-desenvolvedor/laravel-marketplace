<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * You can send $categories to views using two ways:
         *
         * View Share:
         *  view()->share('categories', $categories);
         *
         * View Composer:
         *  $categories = Category::all('name', 'slug');
         *  view()->composer('*', function ($view) use ($categories) {
         *      $view->with('categories', $categories);
         *  });
         */

        view()->composer('*', 'App\Http\Views\CategoryViewComposer@compose');
    }
}
