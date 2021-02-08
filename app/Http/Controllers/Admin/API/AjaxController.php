<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;

class AjaxController extends Controller
{
    public function subCategories(Request $request)
    {
        $subCategories = [];
        if ( $request->has( 'fund_category_id' ) ) {
            $subCategories = SubCategory::where('fund_category_id', $request->fund_category_id)->pluck('type', 'id');
        }
        return response()->json($subCategories);
    }
}
