<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Status;
use Gate;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function _construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= User::orderby('status_id','DESC')->get();
return view('admin.users.index')->with('users', $users);
    }

public function edit(User $user){

        if(Gate::denies('edit-users')){
            return redirect(route('admin.users.index'));
        }
        $roles=Role::all();
        return view('admin.users.edit')->with([
            'user'=>$user,
            'roles'=>$roles

        ]);

}

public function update(Request $request, User $user){
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.index');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('admin.users.index'));
        }
        $user->roles()->detach();

        $user->delete();
        return redirect()->route('admin.users.index');
    }


    public function confirmed(User $user){


        $user->status_id="1";
        $user->update(['status_id'=>$user->status_id]);

        return redirect('/admin/users')->with('success', 'Perdoruesi u aprovua me sukses!');
    }

    public function showId($filename){
        return response()->download(storage_path('app/card/'.$filename));
    }
}
