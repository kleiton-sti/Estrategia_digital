<?php

namespace App\Http\Controllers;

use App\Models\AcoesInovacao;

class AcoesInovacaoController extends Controller
{
    public function index()
    {
        $acoes = AcoesInovacao::all();

        $servicos_online = AcoesInovacao::where('categoria', 'servicos_online')
            ->orderBy('realizado_2025', 'desc')
            ->orderBy('status_2025', 'desc')
            ->get();

        $sistemas_digitais = AcoesInovacao::where('categoria', 'sistemas_digitais')
            ->orderBy('realizado_2025', 'desc')
            ->get();

        $participacao = AcoesInovacao::where('categoria', 'participacao_do_cidadao')
            ->orderBy('realizado_2025', 'desc')
            ->orderBy('status_2025', 'desc')
            ->get();

        $adequacao = AcoesInovacao::where('categoria', 'adequacao_municipal')
            ->orderBy('realizado_2025', 'desc')
            ->orderBy('status_2025', 'desc')
            ->get();

        $totalAcoes = $acoes->count();
        $acoesFeitas = $acoes->filter(function ($item) {
            return $item->status_2024 || $item->status_2025;
        })->count();

        // Porcentagem concluída
        $percentual = $totalAcoes > 0 ? round(($acoesFeitas / $totalAcoes) * 100) : 0;

        return view('tabelas', compact(
            'servicos_online',
            'sistemas_digitais',
            'participacao',
            'adequacao',
            'totalAcoes',
            'acoesFeitas',
            'percentual'
        ));
    }
}
