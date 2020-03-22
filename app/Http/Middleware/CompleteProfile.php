<?php

namespace App\Http\Middleware;

use Closure;

class CompleteProfile
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
        if (auth()->user()->complete_setup) {
            return $next($request);
        }
        return redirect(route('welcome'));
    }
}
