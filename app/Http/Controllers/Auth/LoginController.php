<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo(){
    if (Auth::user()->hasAnyRoles(['admin', 'manager'])){
        $this->redirectTo = route('admin.users.index');
        return $this->redirectTo;
    }else if(Auth::user()->calculateAge(Auth::user()) > 18){
    $this->redirectTo = route('home');
        return $this->redirectTo;
    }else  $this->redirectTo = route('user.upload.id');
        return $this->redirectTo;

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
