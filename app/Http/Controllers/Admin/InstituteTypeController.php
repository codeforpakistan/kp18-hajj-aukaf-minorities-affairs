<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\InstituteTypeDataTable;
use App\Http\Controllers\Controller;
use App\Models\InstituteType;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHelper;
use Illuminate\Validation\ValidationException;

class InstituteTypeController extends Controller
{
    protected $indexRoute = 'admin.institute-types.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InstituteTypeDataTable $dataTable)
    {
        try{
            return $dataTable->render('admin.institute-types.index');
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
        return view('admin.institute-types.create');
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
                'type' => 'unique:institute_types'
            ]);
            $instituteType = InstituteType::create($request->only(['type']));
            if($instituteType->wasRecentlyCreated)
            {
                return redirect()->route($this->indexRoute)->with('create-success', 'The record has been created!');
            }
            return redirect()->route($this->indexRoute)->with('create-failed', 'Could not create the record!');
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
            $instituteType = InstituteType::find($id);
            return view('admin.institute-types.show', [
                'instituteType' => $instituteType,
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
            $instituteType = InstituteType::find($id);
            return view('admin.institute-types.edit', [
                'instituteType' => $instituteType,
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
                'type' => 'unique:institute_types'
            ]);
            
            $instituteType = InstituteType::find($id);

            if( ! $instituteType){
                return redirect()->route($this->indexRoute)->with('edit-failed', 'Could not find the record!');
            }

            $recordUpdated = $instituteType->update($request->only(['type']));
            
            if ($recordUpdated) {
                return redirect()->route($this->indexRoute)->with('edit-success', 'The record has been updated!');
            } else {
                return redirect()->route($this->indexRoute)->with('edit-failed', 'Could not update the record!');
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
            $instituteType = InstituteType::find($id);
            $recordDeleted = $instituteType->delete();
            if ( ! $recordDeleted ) {
                return redirect()->back()->with('delete-failed', 'Could not delete the record');
            }
            return redirect()->back()->with('delete-success', 'The record has been deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }
}
