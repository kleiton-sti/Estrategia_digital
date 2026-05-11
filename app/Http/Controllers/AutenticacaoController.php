<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutenticacaoRequest;
use App\Services\AutenticacaoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AutenticacaoController extends Controller
{
    public function __construct(protected AutenticacaoService $autenticacaoService) {}

    public function exibirLogin(): View
    {
        try {
            return view('autenticacao.login');
        } catch (\Throwable $e) {
            Log::error('Erro ao exibir login: ' . $e->getMessage());
            abort(500);
        }
    }

    public function autenticar(AutenticacaoRequest $request): RedirectResponse
    {
        try {
            $autenticado = $this->autenticacaoService->autenticar($request->validated());

            if (!$autenticado) {
                return back()->withErrors(['email' => 'E-mail ou senha incorretos.'])->withInput();
            }
            
            //evita session fixation atack
            $request->session()->regenerate();

            return redirect()->route('artigos.painel');
        } catch (\Throwable $e) {
            Log::error('Erro ao autenticar: ' . $e->getMessage());
            abort(500);
        }
    }

    public function sair(Request $request): RedirectResponse
    {
        try {
            $this->autenticacaoService->encerrarSessao();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('home');
        } catch (\Throwable $e) {
            Log::error('Erro ao encerrar sessão: ' . $e->getMessage());
            abort(500);
        }
    }
}
