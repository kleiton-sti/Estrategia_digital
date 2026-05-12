<?php

namespace App\Services;

use App\Models\AcoesInovacao;
use Illuminate\Support\Facades\Log;

class AcoesInovacaoService
{
    public function dadosTabelas(): array
    {
        try {
            $base = fn(string $cat) => AcoesInovacao::where('categoria', $cat);

            $servicos_online   = (clone $base)('servicos_online')
                ->orderBy('realizado_2025', 'desc')
                ->orderBy('status_2025', 'desc')
                ->get();

            $sistemas_digitais = (clone $base)('sistemas_digitais')
                ->orderBy('realizado_2025', 'desc')
                ->get();

            $participacao      = (clone $base)('participacao_do_cidadao')
                ->orderBy('realizado_2025', 'desc')
                ->orderBy('status_2025', 'desc')
                ->get();

            $adequacao         = (clone $base)('adequacao_municipal')
                ->orderBy('realizado_2025', 'desc')
                ->orderBy('status_2025', 'desc')
                ->get();

            $acoes       = AcoesInovacao::all();
            $totalAcoes  = $acoes->count();
            $acoesFeitas = $acoes->filter(fn($i) => $i->status_2024 || $i->status_2025)->count();
            $percentual  = $totalAcoes > 0 ? round(($acoesFeitas / $totalAcoes) * 100) : 0;

            return compact(
                'servicos_online',
                'sistemas_digitais',
                'participacao',
                'adequacao',
                'totalAcoes',
                'acoesFeitas',
                'percentual'
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao carregar tabelas de ações: ' . $e->getMessage());
            abort(500);
        }
    }
}
