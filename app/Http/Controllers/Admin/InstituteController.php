<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\InstituteDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\InstituteType;
use App\Models\Institute;
use Illuminate\Http\Request;

class InstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InstituteDataTable $dataTable)
    {
        return $dataTable->render('admin.institutes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instituteTypes = InstituteType::pluck('type', 'id');
        $cities = City::pluck('name', 'id');
        return view('admin.institutes.create',[
            'instituteTypes' => $instituteTypes,
            'cities' => $cities,
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
            'name' => 'unique:institutes'
        ]);
        
        $institute = Institute::create($request->only(['name','city_id','institute_type_id','institute_sector','address']));
        if($institute->wasRecentlyCreated)
        {
            return redirect()->route('admin.institutes.index')->with('create-success', 'The record has been created!');
        }
        return redirect()->route('admin.institutes.index')->with('create-failed', 'Could not create the record!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $institute = Institute::find($id);
        return view('admin.institutes.show', [
            'institute' => $institute,
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
        $institute = Institute::find($id);
        $instituteTypes = InstituteType::pluck('type', 'id');
        $cities = City::pluck('name', 'id');
        return view('admin.institutes.edit', [
            'institute' => $institute,
            'instituteTypes' => $instituteTypes,
            'cities' => $cities
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
        $institute = Institute::find($id);

        if( ! $institute){
            return redirect()->route('admin.institutes.index')->with('edit-failed', 'Could not find the record!');
        }

        $recordUpdated = $institute->update($request->only(['name','city_id','institute_type_id','institute_sector','address']));
        
        if ($recordUpdated) {
            return redirect()->route('admin.institutes.index')->with('edit-success', 'The record has been updated!');
        } else {
            return redirect()->route('admin.institutes.index')->with('edit-failed', 'Could not update the record!');
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
        $institute = Institute::find($id);
        $recordDeleted = $institute->delete();
        if ( ! $recordDeleted ) {
            return redirect()->back()->with('delete-failed', 'Could not delete the record');
        }
        return redirect()->back()->with('delete-success', 'The record has been deleted');
    }
}
