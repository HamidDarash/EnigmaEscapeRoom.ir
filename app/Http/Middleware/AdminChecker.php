<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminChecker {

    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && (Auth::User()->hasRole('admin') || Auth::User()->hasRole('super_admin')))
        {
            return $next($request);
        }

        return redirect('admin_no_auth');
    }
}