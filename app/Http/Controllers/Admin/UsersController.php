<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Status;
use Carbon\Carbon;
use Gate;
use DB;
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


    //Listim te perdoruesve sipas statusit, pending-processing-confirmed

    public function index()
    {
        $users= User::orderby('status_id','DESC')->get();
return view('admin.users.index')->with('users', $users);


    }

    //Kontrollon pamjen e ndryshimit te te drejtave te perdoruesve

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

    //Ndryshim te te drejtave te perdoruesve

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

    //Fshirje e nje perdoruesi, e drejte vetem e Admin

    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('admin.users.index'));
        }
        $user->roles()->detach();

        $user->delete();
        return redirect()->route('admin.users.index');
    }

    //Ne klikim te butonit Aprovo, ndryshon statusin ne "Confirmed" te nje perdoruesi i cili eshte ne statusin "Processing"

    public function confirmed(User $user){

        $confirmed=DB::table('statuses')->select('id')
            ->where('name', 'confirmed')->first();

        $user->update(['status_id'=>$confirmed->id]);

        return redirect('/admin/users')->with('success', 'Perdoruesi u aprovua me sukses!');
    }

    //Download ID e perdoruesit

    public function showId($filename){
        return response()->download(storage_path('app/card/'.$filename));
    }
}
