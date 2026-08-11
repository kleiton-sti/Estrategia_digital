<?php

namespace App\Http\Controllers;

use App\Services\AcoesInovacaoService;
use Illuminate\Support\Facades\Log;

class AcoesInovacaoController extends Controller
{
    public function __construct(protected AcoesInovacaoService $acoesService) {}

    public function index()
    {
        try {
            return vie('tabelas', $this->acoesService->dadosTabelas());
        } catch (\Throwable $e) {
            Log::error('Erro ao carregar tabelas: ' . $e->getMessage());
            return view('error.error500');
        }
    }
}
