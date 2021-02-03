<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FundCategoryRequest;
use App\DataTables\FundCategoryDataTable;
use App\Models\FundCategory;

class FundCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FundCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.fund-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fund-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FundCategoryRequest $request)
    {
        $fundCategory = FundCategory::create($request->only(['type_of_fund', 'description']));
        if ($fundCategory->wasRecentlyCreated) {
            return redirect()->route('admin.fund-categories.index')->with('create-success', 'The record has been created!');
        } else {
            return redirect()->route('admin.fund-categories.index')->with('create-failed', 'Could not create the record!');
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
        $fundCategory = FundCategory::find($id);
        return view('admin.fund-categories.show', [
            'fundCategory' => $fundCategory,
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
        $fundCategory = FundCategory::find($id);
        return view('admin.fund-categories.edit', [
            'fundCategory' => $fundCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FundCategoryRequest $request, $id)
    {
        $fundCategory = FundCategory::find($id);

        $recordUpdated = $fundCategory->update($request->only(['type_of_fund', 'description']));
        if ($recordUpdated) {
            return redirect()->route('admin.fund-categories.index')->with('edit-success', 'The record has been updated!');
        } else {
            return redirect()->route('admin.fund-categories.index')->with('edit-failed', 'Could not update the record!');
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
        $fundCategory = FundCategory::find($id);
        $recordDeleted = $fundCategory->delete();
        if ( ! $recordDeleted ) {
            return redirect()->back()->with('delete-failed', 'Could not delete the record');
        }
        return redirect()->back()->with('delete-success', 'The record has been deleted');
    }
}
