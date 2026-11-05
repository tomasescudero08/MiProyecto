<?php

namespace App\Http\Middleware;

use Closure; // <-- Agrega 'use' antes de Closure
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }
        return redirect()->route('dashboard')->with('error', 'No tienes permisos de administrador para acceder a esta sección.');
    }
}
