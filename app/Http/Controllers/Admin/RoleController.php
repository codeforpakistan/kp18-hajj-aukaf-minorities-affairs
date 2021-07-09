<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ExceptionHelper;
use App\Models\Role;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    protected $indexRoute = 'admin.roles.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $dataTable)
    {
        try{
            return $dataTable->render('admin.roles.index');
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
        return view('admin.roles.create');
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
                'name' => 'unique:roles'
            ]);
            $role = Role::create($request->only(['name']));
            if($role->wasRecentlyCreated)
            {
                return redirect()->route('admin.roles.index')->with('create-success', 'The record has been created!');
            }
            return redirect()->route('admin.roles.index')->with('create-failed', 'Could not create the record!');
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator);

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
            $role = Role::find($id);
            return view('admin.roles.show', [
                'role' => $role,
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
            $role = Role::find($id);
            return view('admin.roles.edit', [
                'role' => $role,
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
                'name' => 'unique:roles,name,'.$id
            ]);
            $role = Role::find($id);

            if( ! $role){
                return redirect()->route('admin.roles.index')->with('edit-failed', 'Could not find the record!');
            }

            $recordUpdated = $role->update($request->only(['name']));
            
            if ($recordUpdated) {
                return redirect()->route('admin.roles.index')->with('edit-success', 'The record has been updated!');
            } else {
                return redirect()->route('admin.roles.index')->with('edit-failed', 'Could not update the record!');
            }
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator);

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
            $role = Role::find($id);
            $recordDeleted = $role->delete();
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
