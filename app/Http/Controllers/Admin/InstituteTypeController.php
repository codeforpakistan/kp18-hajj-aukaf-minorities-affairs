<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\InstituteTypeDataTable;
use App\Http\Controllers\Controller;
use App\Models\InstituteType;
use Illuminate\Http\Request;

class InstituteTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InstituteTypeDataTable $dataTable)
    {
        return $dataTable->render('admin.institute-types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.institute-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $instituteType = InstituteType::create($request->only(['type']));
        if($instituteType->wasRecentlyCreated)
        {
            return redirect()->route('admin.institute-types.index')->with('create-success', 'The record has been created!');
        }
        return redirect()->route('admin.institute-types.index')->with('create-failed', 'Could not create the record!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instituteType = InstituteType::find($id);
        return view('admin.institute-types.show', [
            'instituteType' => $instituteType,
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
        $instituteType = InstituteType::find($id);
        return view('admin.institute-types.edit', [
            'instituteType' => $instituteType,
        ]);
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
        $instituteType = InstituteType::find($id);

        if( ! $instituteType){
            return redirect()->route('admin.institute-types.index')->with('edit-failed', 'Could not find the record!');
        }

        $recordUpdated = $instituteType->update($request->only(['type']));
        
        if ($recordUpdated) {
            return redirect()->route('admin.institute-types.index')->with('edit-success', 'The record has been updated!');
        } else {
            return redirect()->route('admin.institute-types.index')->with('edit-failed', 'Could not update the record!');
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
        $instituteType = InstituteType::find($id);
        $recordDeleted = $instituteType->delete();
        if ( ! $recordDeleted ) {
            return redirect()->back()->with('delete-failed', 'Could not delete the record');
        }
        return redirect()->back()->with('delete-success', 'The record has been deleted');
    }
}
