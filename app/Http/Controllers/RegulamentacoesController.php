<?php

namespace App\Http\Controllers;

use App\Models\Regulamentacoes;

class RegulamentacoesController extends Controller
{
    public function index()
    {
        // Busca todas as regulamentações ordenadas por data (mais recente primeiro)
        $regulamentacoes = Regulamentacoes::orderBy('publicado_em', 'desc')->get();

        return view('regulamentacoes', compact('regulamentacoes'));
    }
}
