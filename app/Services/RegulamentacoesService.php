<?php

namespace App\Services;

use App\Models\Regulamentacoes;
use Illuminate\Support\Facades\Log;

class RegulamentacoesService
{
    public function listar()
    {
        try {
            return Regulamentacoes::orderBy('publicado_em', 'desc')->get();
        } catch (\Throwable $e) {
            Log::error('Erro ao listar regulamentações: ' . $e->getMessage());
            abort(500);
        }
    }
}
