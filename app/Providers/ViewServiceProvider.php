<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(
            ['admin.layouts.app'], 
            'App\Http\View\Composers\AdminLayoutComposer'
        );
        View::composer(
            ['admin.components.left-sidebar'], 
            'App\Http\View\Composers\LeftSidebarComposer'
        );

    }
}
