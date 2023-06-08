<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LoginAs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) // $loginAs
    {
        if(auth()->check()){
            if (auth()->user()->id_role == 1 ){
                // dd('admin');
                return $next($request);
            }else{
                abort(403, 'Unauthorized');}
        }else{
            return redirect("/login");}



        // if (auth()->user()->loginAs == $loginAs && auth()->check()){
        //     if ($role == 'admin'){
        //         LoginController::registrasiAdmin($id_role = 1);
        //         return redirect()->route('admin.dashboard');
        //     }elseif ($role == 'employee') {
        //         LoginController::registrasiAdmin()
        //     }
        // }


    }
}
