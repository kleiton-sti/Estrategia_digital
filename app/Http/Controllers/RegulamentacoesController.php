<?php

namespace App\Http\Controllers;

use App\Models\Regulamentacoes;
use App\Models\Eixo;

class RegulamentacoesController extends Controller
{
    public function index()
    {
        $todosEixos = Eixo::select('id_eixos', 'titulo')->get();

        // Busca todas as regulamentações ordenadas por data (mais recente primeiro)
        $regulamentacoes = Regulamentacoes::orderBy('publicado_em', 'desc')->get();

        return view('regulamentacoes', compact('regulamentacoes', 'todosEixos'));
    }
}