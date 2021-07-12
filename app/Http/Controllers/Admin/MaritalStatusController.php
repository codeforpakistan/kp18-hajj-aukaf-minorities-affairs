<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MaritalStatusDataTable;
use App\Http\Controllers\Controller;
use App\Models\MaritalStatus;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHelper;
use Illuminate\Validation\ValidationException;

class MaritalStatusController extends Controller
{
    protected $indexRoute = 'admin.marital-statuses.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MaritalStatusDataTable $dataTable)
    {
        try{
            return $dataTable->render('admin.marital-statuses.index');
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
        return view('admin.marital-statuses.create');
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
                'status' => 'unique:marital_statuses'
            ]);
            $maritalStatus = MaritalStatus::create($request->only(['status']));
            if($maritalStatus->wasRecentlyCreated)
            {
                return redirect()->route('admin.marital-statuses.index')->with('create-success', 'The record has been created!');
            }
            return redirect()->route('admin.marital-statuses.index')->with('create-failed', 'Could not create the record!');
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
            $maritalStatus = MaritalStatus::find($id);
            return view('admin.marital-statuses.show', [
                'maritalStatus' => $maritalStatus,
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
            $maritalStatus = MaritalStatus::find($id);
            return view('admin.marital-statuses.edit',['maritalStatus' => $maritalStatus]);
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
                'status' => 'unique:marital_statuses,status,'.$id
            ]);

            $maritalStatus = MaritalStatus::find($id);

            if( ! $maritalStatus){
                return redirect()->route('admin.marital-statuses.index')->with('edit-failed', 'Could not find the record!');
            }

            $recordUpdated = $maritalStatus->update($request->only(['status']));
            
            if ($recordUpdated) {
                return redirect()->route('admin.marital-statuses.index')->with('edit-success', 'The record has been updated!');
            } else {
                return redirect()->route('admin.marital-statuses.index')->with('edit-failed', 'Could not update the record!');
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
            $maritalStatus = MaritalStatus::find($id);
            $recordDeleted = $maritalStatus->delete();
            if ( ! $recordDeleted ) {
                return redirect()->back()->with('delete-failed', 'Could not delete the record');
            }
            return redirect()->back()->with('delete-success', 'The record has been deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }
}