<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (session()->has('hak_akses') && session('hak_akses') == 'Admin') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Anda tidak memiliki akses!');
    }
}
