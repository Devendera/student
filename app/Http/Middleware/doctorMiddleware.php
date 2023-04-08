<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class doctorMiddleware
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
        if(Auth::user()->role == 'doctor'){
     		return $next($request);
		}elseif(!empty(Auth::user()->role)){
			if(Auth::user()->role=='admin'){
			    return redirect('admin/dashboard');
			}elseif(Auth::user()->role=='trainer'){
				return redirect('trainer/dashboard');
			}else{
				return redirect('patient/dashboard');
			}
		}else{
		   dd('you can access only that things..');
		}
    } 
}