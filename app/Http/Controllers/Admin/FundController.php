<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FundRequest;
use App\DataTables\FundDataTable;
use App\Models\FundCategory;
use App\Models\SubCategory;
use App\Models\Fund;


class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FundDataTable $dataTable)
    {
        return $dataTable->render('admin.funds.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fundCategories = FundCategory::pluck('type_of_fund', 'id');
        $subCategories = [];
        return view('admin.funds.create', [
            'fundCategories' => $fundCategories,
            'subCategories'  => $subCategories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FundRequest $request)
    {
        $this->validate($request,[
            'fund_name' => 'unique:funds'
        ]);
        $fund = Fund::create($request->only(['fund_category_id', 'sub_category_id', 'fund_name', 'total_amount', 'last_date', 'fund_for_year', 'institute_students', 'active']));
        if ($fund->wasRecentlyCreated) {
            return redirect()->route('admin.funds.index')->with('create-success', 'The record has been created!');
        } else {
            return redirect()->route('admin.funds.index')->with('create-failed', 'Could not create the record!');
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
        $fund = Fund::find($id);
        return view('admin.funds.show', [
            'fund' => $fund,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fund = Fund::find($id);
        $fundCategories = FundCategory::pluck('type_of_fund', 'id');
        $subCategories = SubCategory::where('fund_category_id', $fund->fund_category_id)->pluck('type', 'id');
        return view('admin.funds.edit', [
            'fund' => $fund,
            'fundCategories' => $fundCategories,
            'subCategories'  => $subCategories,
        ]);
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

        $fund = Fund::find($id);

        $recordUpdated = $fund->update($request->only(['fund_category_id', 'sub_category_id', 'fund_name', 'total_amount', 'last_date', 'fund_for_year', 'institute_students', 'active']));
        if ($recordUpdated) {
            return redirect()->route('admin.funds.index')->with('edit-success', 'The record has been updated!');
        } else {
            return redirect()->route('admin.funds.index')->with('edit-failed', 'Could not update the record!');
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
        $fund = Fund::find($id);
        $recordDeleted = $fund->delete();
        if ( ! $recordDeleted ) {
            return redirect()->back()->with('delete-failed', 'Could not delete the record');
        }
        return redirect()->back()->with('delete-success', 'The record has been deleted');
    }
}
