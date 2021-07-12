<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DistrictDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Helpers\ExceptionHelper;

class DistrictController extends Controller
{
    protected $indexRoute = 'admin.districts.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DistrictDataTable $dataTable)
    {
        try{
            return $dataTable->render('admin.districts.index');
        } catch (\Exception $e) {
            return ExceptionHelper::customError($e);
        }
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
        try{
            $this->validate($request,[
                'name' => 'unique:cities'
            ]);
            $city = City::create($request->only(['name','latitude','longitude','province']));
            if($city->wasRecentlyCreated)
            {
                return redirect()->route('admin.districts.index')->with('create-success', 'The record has been created!');
            }
            return redirect()->route('admin.districts.index')->with('create-failed', 'Could not create the record!');
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
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
        try{
            $city = City::find($id);
            return view('admin.districts.show', [
                'city' => $city,
            ]);
        } catch (\Exception $e) {
            return redirect()->route($this->indexRoute)->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $district = City::find($id);
            return view('admin.districts.edit', [
                'district' => $district,
            ]);
        } catch (\Exception $e) {
            return redirect()->route($this->indexRoute)->with('error', ExceptionHelper::somethingWentWrong($e));
        }
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
        try{
            
            $this->validate($request,[
                'name' => 'unique:cities,name,'.$id
            ]);
            
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
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
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
        try{
            $city = City::find($id);
            $recordDeleted = $city->delete();
            if ( ! $recordDeleted ) {
                return redirect()->back()->with('delete-failed', 'Could not delete the record');
            }
            return redirect()->back()->with('delete-success', 'The record has been deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }
}