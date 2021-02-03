<?php

namespace App\Http\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use App\Models\Fund;

class LeftSidebarComposer
{
    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
    	//
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $eduFunds = Fund::where('active', 1)->where('sub_category_id',3)->get();
        $navigationLinks = file_get_contents(base_path('resources/views/admin/components/sidebar-links.json'));
        $route = explode('.', Route::currentRouteName());
        $view->with('routeGroup', $route[0]);
        $view->with('routeController', $route[1]);
        $view->with('routeAction', $route[2]);
        $view->with('navigationLinks', json_decode($navigationLinks));
        $view->with('eduFunds', $eduFunds);
    }
}