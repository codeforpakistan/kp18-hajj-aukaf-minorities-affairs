<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DistrictDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DistrictDataTable $dataTable)
    {
        return $dataTable->render('admin.districts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.districts.create');
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
            'name' => 'unique:cities'
        ]);
        $city = City::create($request->only(['name','latitude','longitude','province']));
        if($city->wasRecentlyCreated)
        {
            return redirect()->route('admin.districts.index')->with('create-success', 'The record has been created!');
        }
        return redirect()->route('admin.districts.index')->with('create-failed', 'Could not create the record!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::find($id);
        return view('admin.districts.show', [
            'city' => $city,
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
        $district = City::find($id);
        return view('admin.districts.edit', [
            'district' => $district,
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
        $district = City::find($id);

        if( ! $district){
            return redirect()->route('admin.districts.index')->with('edit-failed', 'Could not find the record!');
        }

        $recordUpdated = $district->update($request->only(['name','latitude','longitude','province']));
        
        if ($recordUpdated) {
            return redirect()->route('admin.districts.index')->with('edit-success', 'The record has been updated!');
        } else {
            return redirect()->route('admin.districts.index')->with('edit-failed', 'Could not update the record!');
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
        $city = City::find($id);
        $recordDeleted = $city->delete();
        if ( ! $recordDeleted ) {
            return redirect()->back()->with('delete-failed', 'Could not delete the record');
        }
        return redirect()->back()->with('delete-success', 'The record has been deleted');
    }
}