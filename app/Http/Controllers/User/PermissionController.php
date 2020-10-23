<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\User;
use DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function _construct(){
        $this->middleware('status');
    }

    public function index(User $user)


    {
        $user= Auth::user();
        return view('user.index')->with('user', $user);
    }

    //Update te perdoruesit duke shtuar dokumentin ID dhe ndryshimin ne statusin nga "pending" ne "processing"

    public function update(Request $request, $id=null)
    {
        $data = $request->all();

        $processing=DB::table('statuses')->select('id')
            ->where('name', '=', 'processing')->first();

        if($request->hasFile('card')) {
            $filename = $request->card->getClientOriginalName();
            $request->card->storeAs('card', $filename);

           User::where(['id'=>$id])->update(['card'=>$filename, 'status_id'=>$processing->id]);
        }
        return redirect('/user/processing');
        }

     //Shfaq pamjen perdoruesit kur Karta ID eshte ne proces per tu aprovuar
    public function showProcessing(){

        return view('user.processing');
    }

}
