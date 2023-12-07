<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Verifica se o usuário está logado
        if (Auth::check()) {
            // Verifica se o usuário possui a permissão de administrador
            if (Auth::user()->hasPermissionTo('admin')) {
                return $next($request);
            }
        }

        // Redireciona para uma página de acesso negado ou realiza outra ação desejada
        return redirect()->route('access.denied');
    }
}
