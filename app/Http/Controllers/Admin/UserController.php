<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('admin.users.create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'address' => 'required',
            'role_id' => 'required'
        ]);

        $data = $request->only(['name','password','email','phone','address','role_id']);
        $data['password'] = bcrypt($data['password']);
        
        $role = Role::find($data['role_id']);
        if( ! $role){
            \Session::flash('edit-failed', 'Could not find the role!');
            return redirect()->route('admin.users.index');
        }

        $user = User::create($data);
        if($user->wasRecentlyCreated)
        {
            $user->syncRoles([$role->name]);
            \Session::flash('create-success', 'The record has been created!');
            return redirect()->route('admin.users.index');
        }
        \Session::flash('create-failed', 'Could not create the record!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::pluck('name', 'id');
        $user = User::with('roles')->find($id);
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for changing the password.
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        $user = auth()->user();
        return view('admin.users.change-password', [
            'user' => $user
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function changePasswordSubmit(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);

        $hashedPassword = auth()->user()->password;
         
        if (\Hash::check($request->old_password , $hashedPassword )) {

            if (!\Hash::check($request->password , $hashedPassword)) {

                $user = User::find(auth()->user()->id);
                $user->password = bcrypt($request->password);
                $user->update();
                $message = 'Password updated successfully';
                \Session::flash('success',$message);
                return redirect('/admin/dashboard');
            }

            else{
                $message = 'New password can not be same as current/old password!';
                \Session::flash('error',$message);
                return redirect()->back();
            }

        }

        else{
            $message = 'Old password does not matched';
            \Session::flash('error',$message);
            return redirect()->back();
        }

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
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

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'phone' => 'required',
            'address' => 'required',
            'role_id' => 'required'
        ]);

        $user = User::find($id);
        $role = Role::find($request->role_id);
        if( ! $role){
            \Session::flash('edit-failed', 'Could not find the role!');
            return redirect()->route('admin.users.index');
        }
        if( ! $user){
            \Session::flash('edit-failed', 'Could not find the record!');
            return redirect()->route('admin.users.index');
        }

        \DB::beginTransaction();
        $data = $request->only(['name','email','phone','address']);
        
        if(isset($request->password) && strlen($request->password) > 0)
        {
            $data['password'] = bcrypt($request->password);
        }

        $user->syncRoles([$role->name]);

        $recordUpdated = $user->update($data);
        \DB::commit();
        if ($recordUpdated) {
            \Session::flash('edit-success', 'The record has been updated!');
            return redirect()->route('admin.users.index');
        } else {
            \DB::rollback();
            \Session::flash('edit-failed', 'Could not update the record!');
            return redirect()->route('admin.users.index');
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
        $user = User::find($id);
        $recordDeleted = $user->delete();
        if ( ! $recordDeleted ) {
            \Session::flash('delete-failed', 'Could not delete the record');
            return redirect()->back();
        }
        \Session::flash('delete-success', 'The record has been deleted');
        return redirect()->back();
    }
}