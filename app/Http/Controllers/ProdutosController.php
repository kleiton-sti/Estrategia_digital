<?php

namespace App\Http\Controllers;

use App\Models\Eixo;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    


    public function numeros()
    {

         $todosEixos = Eixo::select('id_eixos', 'titulo')->get();

        // Pega todos os eixos com seus roadmap ordenados por status
        $eixos = Eixo::with(['roadmaps' => function($query) {
            $query->orderByRaw("FIELD(status, 'entregue_recentemente', 'em_andamento', 'explorando')");
        }])->get();

        return view('produtos.stii', compact('todosEixos', 'eixos'));
    }
    
     public function allHands()
    {

         $todosEixos = Eixo::select('id_eixos', 'titulo')->get();

        // Pega todos os eixos com seus roadmap ordenados por status
        $eixos = Eixo::with(['roadmaps' => function($query) {
            $query->orderByRaw("FIELD(status, 'entregue_recentemente', 'em_andamento', 'explorando')");
        }])->get();

        return view('produtos.hands', compact('todosEixos', 'eixos'));
    }
}
