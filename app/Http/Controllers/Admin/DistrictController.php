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
                \Session::flash('create-success', 'The record has been created!');
                return redirect()->route('admin.districts.index');
            }
            \Session::flash('create-failed', 'Could not create the record!');
            return redirect()->route('admin.districts.index');
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->back();
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
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->route($this->indexRoute);
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
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->route($this->indexRoute);
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
                \Session::flash('edit-failed', 'Could not find the record!');
                return redirect()->route('admin.districts.index');
            }

            $recordUpdated = $district->update($request->only(['name','latitude','longitude','province']));
            
            if ($recordUpdated) {
                \Session::flash('edit-success', 'The record has been updated!');
                return redirect()->route('admin.districts.index');
            } else {
                \Session::flash('edit-failed', 'Could not update the record!');
                return redirect()->route('admin.districts.index');
            }
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->back();
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
                \Session::flash('delete-failed', 'Could not delete the record');
                return redirect()->back();
            }
            \Session::flash('delete-success', 'The record has been deleted');
            return redirect()->back();
        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->back();
        }
    }
}