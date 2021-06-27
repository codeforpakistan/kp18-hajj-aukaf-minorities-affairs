<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MaritalStatusDataTable;
use App\Http\Controllers\Controller;
use App\Models\MaritalStatus;
use Illuminate\Http\Request;

class MaritalStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MaritalStatusDataTable $dataTable)
    {
        return $dataTable->render('admin.marital-statuses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.marital-statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'status' => 'unique:marital_statuses'
        ]);
        $maritalStatus = MaritalStatus::create($request->only(['status']));
        if($maritalStatus->wasRecentlyCreated)
        {
            return redirect()->route('admin.marital-statuses.index')->with('create-success', 'The record has been created!');
        }
        return redirect()->route('admin.marital-statuses.index')->with('create-failed', 'Could not create the record!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maritalStatus = MaritalStatus::find($id);
        return view('admin.marital-statuses.show', [
            'maritalStatus' => $maritalStatus,
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
        $maritalStatus = MaritalStatus::find($id);
        return view('admin.marital-statuses.edit',['maritalStatus' => $maritalStatus]);
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
        $maritalStatus = MaritalStatus::find($id);

        if( ! $maritalStatus){
            return redirect()->route('admin.marital-statuses.index')->with('edit-failed', 'Could not find the record!');
        }

        $recordUpdated = $maritalStatus->update($request->only(['status']));
        
        if ($recordUpdated) {
            return redirect()->route('admin.marital-statuses.index')->with('edit-success', 'The record has been updated!');
        } else {
            return redirect()->route('admin.marital-statuses.index')->with('edit-failed', 'Could not update the record!');
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
        $maritalStatus = MaritalStatus::find($id);
        $recordDeleted = $maritalStatus->delete();
        if ( ! $recordDeleted ) {
            return redirect()->back()->with('delete-failed', 'Could not delete the record');
        }
        return redirect()->back()->with('delete-success', 'The record has been deleted');
    }
}