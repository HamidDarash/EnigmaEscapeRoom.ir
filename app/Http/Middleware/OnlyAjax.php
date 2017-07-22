<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;

class OnlyAjax
{
    
     /**
     * The URIs that should be excluded from Ajax Checker.
     *
     * @var array
     */
    protected $except = [
        'password/reset',
    ];
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->route()->getPath() != 'logout'){
            if ( ! $request->ajax())
                abort(403);
        }
        return $next($request);
    }
}