<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DateTime;
use Carbon\Carbon;
use App\Role;
use App\Status;
use DB;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birthday' => ['required'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $birthday= date('Y-m-d', strtotime(strtr($data['birthday'], '/', '-')));

        //Ne krijim te perdoruesit, nese eshte +18 i asenjohet statusi "confirmed", ne te kundert statusi "pending"

        if((Carbon::parse($birthday)->diff(Carbon::now())->format('%y years, %m months and %d days'))>=18){
            $status=DB::table('statuses')->select('id')
                ->where('name', '=', 'confirmed')->first();

        }else {
            $status=DB::table('statuses')->select('id')
                ->where('name', '=', 'pending')->first();
        }

        // Krijim te perdoruesit , ku jane shtuar dhe fushat status_id dhe birthday

        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status_id' =>$status->id,
            'birthday' => $birthday,

        ]);

        //Per cdo perdorues qe regjistrohet nga sistemi, asenjohet automatikisht roli "user"
        $role= Role::select('id')->where('name', 'user')->first();
        $user->roles()->attach($role);


        return $user;
    }
}
