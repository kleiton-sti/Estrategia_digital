<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AutenticacaoService
{
    public function autenticar(array $credenciais): bool
    {
        try {
            return Auth::attempt([
                'email'    => $credenciais['email'],
                'password' => $credenciais['password'],
            ]);
        } catch (\Throwable $e) {
            Log::error('Erro ao autenticar usuário: ' . $e->getMessage());
            abort(500);
        }
    }

    public function encerrarSessao(): void
    {
        try {
            Auth::logout();
        } catch (\Throwable $e) {
            Log::error('Erro ao encerrar sessão: ' . $e->getMessage());
            abort(500);
        }
    }
}
