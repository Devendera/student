<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class trainerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role == 'trainer'){
     		return $next($request);
		}elseif(!empty(Auth::user()->role)){
			if(Auth::user()->role=='admin'){
			    return redirect('admin/dashboard');
			}elseif(Auth::user()->role=='doctor'){
				return redirect('doctor/dashboard');
			}else{
				return redirect('patient/dashboard');
			}
		}else{
		   dd('you can access only that things..');
		}
    } 
}