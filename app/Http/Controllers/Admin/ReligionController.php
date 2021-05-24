<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReligionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Religion;
use Illuminate\Http\Request;

class ReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReligionDataTable $dataTable)
    {
        return $dataTable->render('admin.religions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.religions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $religion = Religion::create($request->only(['religion_name']));
        if($religion->wasRecentlyCreated)
        {
            return redirect()->route('admin.religions.index')->with('create-success', 'The record has been created!');
        }
        return redirect()->route('admin.religions.index')->with('create-failed', 'Could not create the record!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $religion = Religion::find($id);
        return view('admin.religions.show', [
            'religion' => $religion,
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
        $religion = Religion::find($id);
        return view('admin.religions.edit', [
            'religion' => $religion,
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
        $religion = Religion::find($id);

        if( ! $religion){
            return redirect()->route('admin.religions.index')->with('edit-failed', 'Could not find the record!');
        }

        $recordUpdated = $religion->update($request->only(['religion_name']));
        
        if ($recordUpdated) {
            return redirect()->route('admin.religions.index')->with('edit-success', 'The record has been updated!');
        } else {
            return redirect()->route('admin.religions.index')->with('edit-failed', 'Could not update the record!');
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
        $religion = Religion::find($id);
        $recordDeleted = $religion->delete();
        if ( ! $recordDeleted ) {
            return redirect()->back()->with('delete-failed', 'Could not delete the record');
        }
        return redirect()->back()->with('delete-success', 'The record has been deleted');
    }
}
