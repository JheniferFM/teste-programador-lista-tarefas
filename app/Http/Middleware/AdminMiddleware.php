<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica se está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Verifica se é admin
        if (!Auth::user()->is_admin) {
            abort(403, 'Acesso não autorizado');
        }

        return $next($request);
    }
}