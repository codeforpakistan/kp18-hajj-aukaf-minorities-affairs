<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DegreeAwardingBoardDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DegreeAwarding;
use App\Helpers\ExceptionHelper;
use Illuminate\Validation\ValidationException;

class DegreeAwardingBoardController extends Controller
{
    protected $indexRoute = 'admin.degree-awarding-boards.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DegreeAwardingBoardDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.degree-awarding-boards.index');
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
        try{
            $this->validate($request,[
                'name' => 'unique:degree_awardings'
            ]);
            $degreeAwarding = DegreeAwarding::create($request->only(['name']));
            if($degreeAwarding->wasRecentlyCreated)
            {
                \Session::flash('create-success', 'The record has been created!');
                return redirect()->route($this->indexRoute);
            }
            \Session::flash('create-failed', 'Could not create the record!');
            return redirect()->route($this->indexRoute);
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
            $degreeAwarding = DegreeAwarding::find($id);
            return view('admin.degree-awarding-boards.show', [
                'degreeAwarding' => $degreeAwarding,
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
            $degreeAwarding = DegreeAwarding::find($id);
            return view('admin.degree-awarding-boards.edit',['degreeAwarding' => $degreeAwarding]);
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
                'name' => 'unique:degree_awardings,name,'.$id
            ]);
            $degreeAwarding = DegreeAwarding::find($id);

            if( ! $degreeAwarding){
                \Session::flash('edit-failed', 'Could not find the record!');
                return redirect()->route($this->indexRoute);
            }

            $recordUpdated = $degreeAwarding->update($request->only(['name']));
            
            if ($recordUpdated) {
                \Session::flash('edit-success', 'The record has been updated!');
                return redirect()->route($this->indexRoute);
            } else {
                \Session::flash('edit-failed', 'Could not update the record!');
                return redirect()->route($this->indexRoute);
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
        try {
            $degreeAwarding = DegreeAwarding::find($id);
            $recordDeleted = $degreeAwarding->delete();
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