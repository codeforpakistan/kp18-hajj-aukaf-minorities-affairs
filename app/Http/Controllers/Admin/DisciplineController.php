<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DisciplineDataTable;
use App\Http\Controllers\Controller;
use App\Models\Discipline;
use App\Models\QualificationLevel;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DisciplineDataTable $dataTable)
    {
        return $dataTable->render('admin.disciplines.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qualificationLevels = QualificationLevel::pluck('name','id');
        return view('admin.disciplines.create',[
            'qualificationLevels' => $qualificationLevels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $discipline = Discipline::create($request->only(['discipline','qualification_level_id']));
        if($discipline->wasRecentlyCreated)
        {
            return redirect()->route('admin.disciplines.index')->with('create-success', 'The record has been created!');
        }
        return redirect()->route('admin.disciplines.index')->with('create-failed', 'Could not create the record!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discipline = Discipline::find($id);
        return view('admin.disciplines.show', [
            'discipline' => $discipline,
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
        $discipline = Discipline::find($id);
        $qualificationLevels = QualificationLevel::pluck('name','id');
        return view('admin.disciplines.edit', [
            'discipline' => $discipline,
            'qualificationLevels' => $qualificationLevels
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
        $discipline = Discipline::find($id);

        if( ! $discipline){
            return redirect()->route('admin.disciplines.index')->with('edit-failed', 'Could not find the record!');
        }

        $recordUpdated = $discipline->update($request->only(['discipline','qualification_level_id']));
        
        if ($recordUpdated) {
            return redirect()->route('admin.disciplines.index')->with('edit-success', 'The record has been updated!');
        } else {
            return redirect()->route('admin.disciplines.index')->with('edit-failed', 'Could not update the record!');
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
        $discipline = Discipline::find($id);
        $recordDeleted = $discipline->delete();
        if ( ! $recordDeleted ) {
            return redirect()->back()->with('delete-failed', 'Could not delete the record');
        }
        return redirect()->back()->with('delete-success', 'The record has been deleted');
    }
}
