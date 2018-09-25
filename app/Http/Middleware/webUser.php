<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class webUser
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
		if(Auth::user()->user==1){
			Auth::logout();
            return redirect()->to('/');
		}
        else
			return $next($request);
    }
}
