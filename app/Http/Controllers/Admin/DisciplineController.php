<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DisciplineDataTable;
use App\Http\Controllers\Controller;
use App\Models\Discipline;
use App\Models\QualificationLevel;
use App\Helpers\ExceptionHelper;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    protected $indexRoute = 'admin.disciplines.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DisciplineDataTable $dataTable)
    {
        try{
            return $dataTable->render('admin.disciplines.index');
        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->back();
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

            $qualificationLevels = QualificationLevel::pluck('name','id');
            return view('admin.disciplines.create',[
                'qualificationLevels' => $qualificationLevels
            ]);
        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->back();
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
                'discipline' => 'unique:disciplines',
                'qualification_level_id' => 'required'
            ]);
            $discipline = Discipline::create($request->only(['discipline','qualification_level_id']));
            if($discipline->wasRecentlyCreated)
            {
                \Session::flash('create-success', 'The record has been created!');
                return redirect()->route('admin.disciplines.index');
            }
            \Session::flash('create-failed', 'Could not create the record!');
            return redirect()->route('admin.disciplines.index');
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
            $discipline = Discipline::find($id);
            return view('admin.disciplines.show', [
                'discipline' => $discipline,
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
            $discipline = Discipline::find($id);
            $qualificationLevels = QualificationLevel::pluck('name','id');
            return view('admin.disciplines.edit', [
                'discipline' => $discipline,
                'qualificationLevels' => $qualificationLevels
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
                'discipline' => 'unique:disciplines,discipline,'.$id,
                'qualification_level_id' => 'required'
            ]);
            
            $discipline = Discipline::find($id);

            if( ! $discipline){
                \Session::flash('edit-failed', 'Could not find the record!');
                return redirect()->route('admin.disciplines.index');
            }

            $recordUpdated = $discipline->update($request->only(['discipline','qualification_level_id']));
            
            if ($recordUpdated) {
                \Session::flash('edit-success', 'The record has been updated!');
                return redirect()->route('admin.disciplines.index');
            } else {
                \Session::flash('edit-failed', 'Could not update the record!');
                return redirect()->route('admin.disciplines.index');
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
            $discipline = Discipline::find($id);
            $recordDeleted = $discipline->delete();
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
