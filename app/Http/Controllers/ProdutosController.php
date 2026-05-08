<?php

namespace App\Http\Controllers;

use App\Models\Eixo;

class ProdutosController extends Controller
{
    public function numeros()
    {
        $eixos = Eixo::with(['roadmaps' => function($query) {
            $query->orderByRaw("FIELD(status, 'entregue_recentemente', 'em_andamento', 'explorando')");
        }])->get();

        return view('produtos.stii', compact('eixos'));
    }

    public function allHands()
    {
        $eixos = Eixo::with(['roadmaps' => function($query) {
            $query->orderByRaw("FIELD(status, 'entregue_recentemente', 'em_andamento', 'explorando')");
        }])->get();

        return view('produtos.hands', compact('eixos'));
    }
}
