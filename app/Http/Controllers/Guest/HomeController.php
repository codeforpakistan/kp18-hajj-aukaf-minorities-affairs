<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fund;
use App\Models\Qualification;
use App\Models\QualificationLevel;
use App\Models\DegreeAwarding;
use App\Models\Institute;
use App\Models\Religion;
use App\Models\Applicant;
use App\Models\MaritalStatus;
use App\Models\City;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funds = Fund::where('active', '1')->orderBy('last_date', 'DESC')->pluck('fund_name', 'id');
        $last_date = Fund::where('active', '1')
            ->where('last_date', '>=', date('Y-m-d'))
            ->orderBy('last_date', 'DESC')
            ->get();
        $qualificationLevels = QualificationLevel::pluck('name', 'id');
        $degreeAwardings = DegreeAwarding::pluck('name', 'id');
        $institutes = Institute::where('type', 'university')->pluck('name', 'id');
        $religions = Religion::pluck('religion_name', 'id');
        $maritalstatus = MaritalStatus::pluck('status', 'id');
        $cities = City::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('welcome', [
            'last_date' => $last_date,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
