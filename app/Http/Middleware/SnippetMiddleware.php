<?php

namespace App\Http\Middleware;

use Closure;

class SnippetMiddleware
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
        if(!($request->user()->snippetAccess)){
          abort(403,'You do not have permission to create snippets.');
        }
        return $next($request);
    }
}
