<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use DB;

class StatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */



    public function handle(Request $request, Closure $next)
    {
        $pending=DB::table('statuses')->select('id')->where('name', 'pending')->first();
        $processing= DB::table('statuses')->select('id')->where('name', 'processing')->first();

         //Nese useri i autentikuar ka status "pending" ridirektohet ne faqen per te upload ID
        if(Auth::user()->status_id == $pending->id){
            return redirect('/user/permission');
        }elseif
        //Me status "processing" ridirektohet ne faqen qe tregon dokument ne proces
        (Auth::user()->status_id == $processing->id){
            return redirect('/user/processing');
        }else {

        return $next($request);
        }
    }

}
