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
                \Session::flash('create-success', 'The record has been created!');
                return redirect()->route('admin.roles.index');
            }
            \Session::flash('create-failed', 'Could not create the record!');
            return redirect()->route('admin.roles.index');
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
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
            $role = Role::find($id);
            return view('admin.roles.show', [
                'role' => $role,
            ]);
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
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
            $role = Role::find($id);
            return view('admin.roles.edit', [
                'role' => $role,
            ]);
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
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
                'name' => 'unique:roles,name,'.$id
            ]);
            $role = Role::find($id);

            if( ! $role){
                \Session::flash('edit-failed', 'Could not find the record!');
                return redirect()->route('admin.roles.index');
            }

            $recordUpdated = $role->update($request->only(['name']));
            
            if ($recordUpdated) {
                \Session::flash('edit-success', 'The record has been updated!');
                return redirect()->route('admin.roles.index');
            } else {
                \Session::flash('edit-failed', 'Could not update the record!');
                return redirect()->route('admin.roles.index');
            }
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator)->withInput();

        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
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
            $role = Role::find($id);
            $recordDeleted = $role->delete();
            if ( ! $recordDeleted ) {
                \Session::flash('delete-failed', 'Could not delete the record');
                return redirect()->back();
            }
            \Session::flash('delete-success', 'The record has been deleted');
            return redirect()->back();
        } catch (\Error $e) {
            return ExceptionHelper::customError($e);
        } catch (\Exception $e) {
            \Session::flash('error', ExceptionHelper::somethingWentWrong($e));
            return redirect()->back();
        }
    }
}
