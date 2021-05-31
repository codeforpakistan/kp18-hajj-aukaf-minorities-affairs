<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SelectionPhaseDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Fund;
use App\Models\Institute;
use App\Models\InstituteType;
use App\Models\Religion;
use Illuminate\Http\Request;

class SelectionPhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function distribution(SelectionPhaseDataTable $dataTable)
    {
        $fundsList = Fund::where(['active' => 1])->pluck('fund_name', 'id');
        // if (! request()->has('fund') ) {
        //     return redirect()->route('admin.selection-phase.distribution', ['fund' => $fundsList->keys()->first()]);
        // }
        $citiesList = City::orderBy('name', 'ASC')->pluck('name', 'id');
        $religionsList = Religion::orderBy('religion_name', 'ASC')->pluck('religion_name', 'id');

        return $dataTable->render('admin.selection-phase.distribution',[
            'fundsList'     => $fundsList,
            'citiesList'    => $citiesList,
            'religionsList' => $religionsList
        ]);
    }
}
