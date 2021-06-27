<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\QualificationLevelDataTable;
use App\Http\Controllers\Controller;
use App\Models\InstituteType;
use App\Models\QualificationLevel;
use Illuminate\Http\Request;

class QualificationLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QualificationLevelDataTable $dataTable)
    {
        return $dataTable->render('admin.qualification-levels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instituteTypes = InstituteType::pluck('type', 'id');
        return view('admin.qualification-levels.create', [
            'instituteTypes' => $instituteTypes,
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
        $this->validate($request,[
            'name' => 'unique:qualification_levels'
        ]);
        $qualificationLevel = QualificationLevel::create($request->only(['name','institute_type_id']));
        if($qualificationLevel->wasRecentlyCreated)
        {
            return redirect()->route('admin.qualification-levels.index')->with('create-success', 'The record has been created!');
        }
        return redirect()->route('admin.qualification-levels.index')->with('create-failed', 'Could not create the record!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $qualificationLevel = QualificationLevel::find($id);
        return view('admin.qualification-levels.show', [
            'qualificationLevel' => $qualificationLevel,
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
        $qualificationLevel = QualificationLevel::find($id);
        $instituteTypes = InstituteType::pluck('type', 'id');
        return view('admin.qualification-levels.edit', [
            'qualificationLevel' => $qualificationLevel,
            'instituteTypes' => $instituteTypes,
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
        $qualificationLevel = QualificationLevel::find($id);

        if( ! $qualificationLevel){
            return redirect()->route('admin.qualification-levels.index')->with('edit-failed', 'Could not find the record!');
        }

        $recordUpdated = $qualificationLevel->update($request->only(['name','institute_type_id']));
        
        if ($recordUpdated) {
            return redirect()->route('admin.qualification-levels.index')->with('edit-success', 'The record has been updated!');
        } else {
            return redirect()->route('admin.qualification-levels.index')->with('edit-failed', 'Could not update the record!');
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
        $qualificationLevel = QualificationLevel::find($id);
        $recordDeleted = $qualificationLevel->delete();
        if ( ! $recordDeleted ) {
            return redirect()->back()->with('delete-failed', 'Could not delete the record');
        }
        return redirect()->back()->with('delete-success', 'The record has been deleted');
    }
}
