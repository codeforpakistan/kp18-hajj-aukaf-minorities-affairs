<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\QualificationLevelDataTable;
use App\Http\Controllers\Controller;
use App\Models\InstituteType;
use App\Models\QualificationLevel;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHelper;
use Illuminate\Validation\ValidationException;

class QualificationLevelController extends Controller
{
    protected $indexRoute = 'admin.qualification-levels.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QualificationLevelDataTable $dataTable)
    {
        try{
            return $dataTable->render('admin.qualification-levels.index');
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
            return view('admin.qualification-levels.create', [
                'instituteTypes' => $instituteTypes,
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
                'name' => 'unique:qualification_levels'
            ]);
            $qualificationLevel = QualificationLevel::create($request->only(['name','institute_type_id']));
            if($qualificationLevel->wasRecentlyCreated)
            {
                \Session::flash('create-success', 'The record has been created!');
                return redirect()->route('admin.qualification-levels.index');
            }
            \Session::flash('create-failed', 'Could not create the record!');
            return redirect()->route('admin.qualification-levels.index');
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
            $qualificationLevel = QualificationLevel::find($id);
            return view('admin.qualification-levels.show', [
                'qualificationLevel' => $qualificationLevel,
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
            $qualificationLevel = QualificationLevel::find($id);
            $instituteTypes = InstituteType::pluck('type', 'id');
            return view('admin.qualification-levels.edit', [
                'qualificationLevel' => $qualificationLevel,
                'instituteTypes' => $instituteTypes,
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
                'name' => 'unique:qualification_levels,name,'.$id
            ]);
            $qualificationLevel = QualificationLevel::find($id);

            if( ! $qualificationLevel){
                \Session::flash('edit-failed', 'Could not find the record!');
                return redirect()->route('admin.qualification-levels.index');
            }

            $recordUpdated = $qualificationLevel->update($request->only(['name','institute_type_id']));
            
            if ($recordUpdated) {
                \Session::flash('edit-success', 'The record has been updated!');
                return redirect()->route('admin.qualification-levels.index');
            } else {
                \Session::flash('edit-failed', 'Could not update the record!');
                return redirect()->route('admin.qualification-levels.index');
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
            $qualificationLevel = QualificationLevel::find($id);
            $recordDeleted = $qualificationLevel->delete();
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
