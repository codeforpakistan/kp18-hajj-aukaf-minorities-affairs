<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SchoolClassDataTable;
use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHelper;
use Illuminate\Validation\ValidationException;

class SchoolClassController extends Controller
{
    protected $indexRoute = 'admin.school-classes.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SchoolClassDataTable $dataTable)
    {
        try{
            return $dataTable->render('admin.school-classes.index');
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
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
        return view('admin.school-classes.create');
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
                'class_number' => 'unique:school_classes'
            ]);
            $schoolClass = SchoolClass::create($request->only(['class_number']));
            if($schoolClass->wasRecentlyCreated)
            {
                return redirect()->route('admin.school-classes.index')->with('create-success', 'The record has been created!');
            }
            return redirect()->route('admin.school-classes.index')->with('create-failed', 'Could not create the record!');
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
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
            $schoolClass = SchoolClass::find($id);
            return view('admin.school-classes.show', [
                'schoolClass' => $schoolClass,
            ]);
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
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
            $schoolClass = SchoolClass::find($id);
            return view('admin.school-classes.edit', [
                'schoolClass' => $schoolClass
            ]);
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
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
                'class_number' => 'unique:school_classes,class_number,'.$id
            ]);

            $schoolClass = SchoolClass::find($id);

            if( ! $schoolClass){
                return redirect()->route('admin.school-classes.index')->with('edit-failed', 'Could not find the record!');
            }

            $recordUpdated = $schoolClass->update($request->only(['class_number']));
            
            if ($recordUpdated) {
                return redirect()->route('admin.school-classes.index')->with('edit-success', 'The record has been updated!');
            } else {
                return redirect()->route('admin.school-classes.index')->with('edit-failed', 'Could not update the record!');
            }
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
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
            $schoolClass = SchoolClass::find($id);
            $recordDeleted = $schoolClass->delete();
            if ( ! $recordDeleted ) {
                return redirect()->back()->with('delete-failed', 'Could not delete the record');
            }
            return redirect()->back()->with('delete-success', 'The record has been deleted');
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }
}
