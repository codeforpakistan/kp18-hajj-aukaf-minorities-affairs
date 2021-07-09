<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\InstituteDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\InstituteType;
use App\Models\Institute;
use Illuminate\Validation\ValidationException;
use App\Helpers\ExceptionHelper;
use Illuminate\Http\Request;

class InstituteController extends Controller
{
    protected $indexRoute = 'admin.institutes.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InstituteDataTable $dataTable)
    {
        try{
            return $dataTable->render('admin.institutes.index');
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
        try{
            $instituteTypes = InstituteType::pluck('type', 'id');
            $cities = City::pluck('name', 'id');
            return view('admin.institutes.create',[
                'instituteTypes' => $instituteTypes,
                'cities' => $cities,
            ]);
        } catch (\Exception $e) {
            return redirect()->route($this->indexRoute)->with('error', ExceptionHelper::somethingWentWrong($e));
        }
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
                'name' => 'unique:institutes'
            ]);
            
            $institute = Institute::create($request->only(['name','city_id','institute_type_id','institute_sector','address']));
            if($institute->wasRecentlyCreated)
            {
                return redirect()->route('admin.institutes.index')->with('create-success', 'The record has been created!');
            }
            return redirect()->route('admin.institutes.index')->with('create-failed', 'Could not create the record!');
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator);

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
            $institute = Institute::find($id);
            return view('admin.institutes.show', [
                'institute' => $institute,
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
            $institute = Institute::find($id);
            $instituteTypes = InstituteType::pluck('type', 'id');
            $cities = City::pluck('name', 'id');
            return view('admin.institutes.edit', [
                'institute' => $institute,
                'instituteTypes' => $instituteTypes,
                'cities' => $cities
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
                'name' => 'unique:institutes,name,'.$id
            ]);
            
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
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator);

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
            $institute = Institute::find($id);
            $recordDeleted = $institute->delete();
            if ( ! $recordDeleted ) {
                return redirect()->back()->with('delete-failed', 'Could not delete the record');
            }
            return redirect()->back()->with('delete-success', 'The record has been deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }
}
