<?php

namespace App\Http\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Models\Fund;

class AdminLayoutComposer
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
    	$funds = Fund::where('active', 1)->where('sub_category_id', 3)->pluck('fund_name', 'id');
        $view->with('edu_funds', $funds);
    }
}