<?php

namespace App\Http\Middleware;

use Closure;

class CheckDirector
{
    public function handle($request, Closure $next)
    {
        if (session()->has('hak_akses') && session('hak_akses') == 'Director') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Anda tidak memiliki akses!');
    }
}
