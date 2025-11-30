<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// Check logged in user
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->user_role == 'admin'){
            return $next($request);
        }

        // If a user is not an admin, return unauthorized access error

       // abort('401');

       // If a user is not an admin, direct to /home (Home Page)
       return redirect('/home');
    }
}
