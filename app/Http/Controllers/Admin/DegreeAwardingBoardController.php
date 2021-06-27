<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DegreeAwardingBoardDataTable;
use App\Http\Controllers\Controller;
use App\Models\DegreeAwarding;
use Illuminate\Http\Request;

class DegreeAwardingBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DegreeAwardingBoardDataTable $dataTable)
    {
        return $dataTable->render('admin.degree-awarding-boards.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.degree-awarding-boards.create');
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
            'name' => 'unique:degree_awardings'
        ]);
        $degreeAwarding = DegreeAwarding::create($request->only(['name']));
        if($degreeAwarding->wasRecentlyCreated)
        {
            return redirect()->route('admin.degree-awarding-boards.index')->with('create-success', 'The record has been created!');
        }
        return redirect()->route('admin.degree-awarding-boards.index')->with('create-failed', 'Could not create the record!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $degreeAwarding = DegreeAwarding::find($id);
        return view('admin.degree-awarding-boards.show', [
            'degreeAwarding' => $degreeAwarding,
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
        $degreeAwarding = DegreeAwarding::find($id);
        return view('admin.degree-awarding-boards.edit',['degreeAwarding' => $degreeAwarding]);
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
        $degreeAwarding = DegreeAwarding::find($id);

        if( ! $degreeAwarding){
            return redirect()->route('admin.degree-awarding-boards.index')->with('edit-failed', 'Could not find the record!');
        }

        $recordUpdated = $degreeAwarding->update($request->only(['name']));
        
        if ($recordUpdated) {
            return redirect()->route('admin.degree-awarding-boards.index')->with('edit-success', 'The record has been updated!');
        } else {
            return redirect()->route('admin.degree-awarding-boards.index')->with('edit-failed', 'Could not update the record!');
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
        $degreeAwarding = DegreeAwarding::find($id);
        $recordDeleted = $degreeAwarding->delete();
        if ( ! $recordDeleted ) {
            return redirect()->back()->with('delete-failed', 'Could not delete the record');
        }
        return redirect()->back()->with('delete-success', 'The record has been deleted');
    }
}