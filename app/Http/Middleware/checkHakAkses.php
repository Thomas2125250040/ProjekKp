<?php

namespace App\Http\Middleware;

use Closure;

class checkHakAkses
{
    public function handle($request, Closure $next)
    {
        if (session()->has('hak_akses')) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Silahkan login terlebih dahulu!');
    }
}
