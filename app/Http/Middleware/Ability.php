<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class Ability
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
        $current_router = $request->route()->getName();
		
		// Check if GATE exists or not 
		/*if (!Gate::has($current_router)) {
			return $next($request);
		}*/
		
		// Check user permission from defined GATE
		if (Gate::allows($current_router)) {
			return $next($request);
		}
		else
		{
			return redirect('denied');
		}
    }
}
