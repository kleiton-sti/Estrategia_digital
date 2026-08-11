<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'rede.stii' => \App\Http\Middleware\VerificaRedeStii::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e, $request) {
            // Mantém o comportamento padrão para requisições que esperam JSON (APIs, uploads, etc.)
            if ($request->expectsJson()) {
                return null;
            }

            // Descobre o status HTTP real da exceção (404, 403, 419...) quando aplicável
            $status = $e instanceof \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface
                ? $e->getStatusCode()
                : 500;

            // Deixa o Laravel tratar normalmente erros que não são de servidor (404, 403, 419, 429...)
            if ($status < 500) {
                return null;
            }

            \Illuminate\Support\Facades\Log::error('Erro não tratado: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'url'       => $request->fullUrl(),
                'trace'     => $e->getTraceAsString(),
            ]);

            // Em ambiente de desenvolvimento (APP_DEBUG=true), deixa a tela de debug padrão aparecer
            if (config('app.debug')) {
                return null;
            }

            return response()->view('error.error500', [], $status);
        });
    })->create();
