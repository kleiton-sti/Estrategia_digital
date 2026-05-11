<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificaRedeStii
{
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        if (!str_starts_with($ip, '192.168.11.')) {
            abort(403, 'Acesso restrito à rede da STII.');
        }

        return $next($request);
    }
}
