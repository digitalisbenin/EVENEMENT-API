<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $roleSupAdm = Role::where('name', 'Super Admin')->first();
        if ( auth()->user()->role_id == $roleSupAdm->id) {
            return $next($request);
        } else {
            session()->flush();
            return redirect()->route('login');
        }
    }
}
