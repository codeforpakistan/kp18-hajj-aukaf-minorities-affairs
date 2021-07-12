<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReligionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Religion;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHelper;
use Illuminate\Validation\ValidationException;

class ReligionController extends Controller
{
    protected $indexRoute = 'admin.religions.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReligionDataTable $dataTable)
    {
        try{
            return $dataTable->render('admin.religions.index');
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
        return view('admin.religions.create');
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
                'religion_name' => 'unique:religions'
            ]);
            $religion = Religion::create($request->only(['religion_name']));
            if($religion->wasRecentlyCreated)
            {
                return redirect()->route('admin.religions.index')->with('create-success', 'The record has been created!');
            }
            return redirect()->route('admin.religions.index')->with('create-failed', 'Could not create the record!');
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
            $religion = Religion::find($id);
            return view('admin.religions.show', [
                'religion' => $religion,
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
            $religion = Religion::find($id);
            return view('admin.religions.edit', [
                'religion' => $religion,
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
                'religion_name' => 'unique:religions,religion_name,'.$id
            ]);
            
            $religion = Religion::find($id);

            if( ! $religion){
                return redirect()->route('admin.religions.index')->with('edit-failed', 'Could not find the record!');
            }

            $recordUpdated = $religion->update($request->only(['religion_name']));
            
            if ($recordUpdated) {
                return redirect()->route('admin.religions.index')->with('edit-success', 'The record has been updated!');
            } else {
                return redirect()->route('admin.religions.index')->with('edit-failed', 'Could not update the record!');
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
            $religion = Religion::find($id);
            $recordDeleted = $religion->delete();
            if ( ! $recordDeleted ) {
                return redirect()->back()->with('delete-failed', 'Could not delete the record');
            }
            return redirect()->back()->with('delete-success', 'The record has been deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', ExceptionHelper::somethingWentWrong($e));
        }
    }
}
