<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ApplicantRequest;
use App\DataTables\ApplicantDataTable;
use App\Http\Controllers\Controller;
use App\Helpers\ExceptionHelper;
use App\Models\Applicant;
use App\Models\Religion;
use App\Models\Fund;
use App\Models\City;

class ApplicantController extends Controller
{
    protected $indexRoute = 'admin.applicants.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ApplicantDataTable $dataTable)
    {
        try{
            $fundsList = Fund::where('active',1)->pluck('fund_name', 'id');
            if (! request()->has('fund') ) {
                return redirect()->route('admin.applicants.index', ['fund' => $fundsList->keys()->last()]);
            }
            $citiesList = City::orderBy('name', 'ASC')->pluck('name', 'id');
            $religionsList = Religion::orderBy('religion_name', 'ASC')->pluck('religion_name', 'id');
            // dd($religionsList);
            return $dataTable->render('admin.applicants.index', [
                'fundsList'     => $fundsList,
                'citiesList'    => $citiesList,
                'religionsList' => $religionsList,
            ]);
        } catch (\Exception $e) {
            return ExceptionHelper::customError($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('guest.home.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FundRequest $request)
    {
        try {
            $fund = Fund::create($request->only(['fund_category_id', 'sub_category_id', 'fund_name', 'total_amount', 'last_date', 'fund_for_year', 'institute_students', 'active']));
            if ($fund->wasRecentlyCreated) {
                return redirect()->route($this->indexRoute)->with('create-success', 'The record has been created!');
            } else {
                return redirect()->route($this->indexRoute)->with('create-failed', 'Could not create the record!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $fund = Fund::find($id);
            return view('admin.applicants.show', [
                'fund' => $fund,
            ]);
        } catch (\Exception $e) {
            return redirect()->route($this->indexRoute)->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $fund = Fund::find($id);
            $fundCategories = FundCategory::pluck('type_of_fund', 'id');
            $subCategories = SubCategory::where('fund_category_id', $fund->fund_category_id)->pluck('type', 'id');
            return view('admin.applicants.edit', [
                'fund' => $fund,
                'fundCategories' => $fundCategories,
                'subCategories'  => $subCategories,
            ]);
        } catch (\Exception $e) {
            return redirect()->route($this->indexRoute)->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FundRequest $request, $id)
    {
        try {
            $fund = Fund::find($id);
            $recordUpdated = $fund->update($request->only(['fund_category_id', 'sub_category_id', 'fund_name', 'total_amount', 'last_date', 'fund_for_year', 'institute_students', 'active']));
            if ($recordUpdated) {
                return redirect()->route($this->indexRoute)->with('edit-success', 'The record has been updated!');
            } else {
                return redirect()->route($this->indexRoute)->with('edit-failed', 'Could not update the record!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $fund = Fund::find($id);
            $recordDeleted = $fund->delete();
            if ( ! $recordDeleted ) {
                return redirect()->back()->with('delete-failed', 'Could not delete the record');
            }
            return redirect()->back()->with('delete-success', 'The record has been deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }
}
