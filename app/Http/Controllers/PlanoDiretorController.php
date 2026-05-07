<?php

namespace App\Http\Controllers;

use App\Models\Eixo;
use Illuminate\Http\Request;

class PlanoDiretorController extends Controller
{
    public function plano()
    {
        $todosEixos = Eixo::select('id_eixos', 'titulo')->get();

        // Pega todos os eixos com seus roadmap ordenados por status
        $eixos = Eixo::with(['roadmaps' => function ($query) {
            $query->orderByRaw("FIELD(status, 'entregue_recentemente', 'em_andamento', 'explorando')");
        }])->get();
        return view('planodiretor.plano',compact('todosEixos', 'eixos'));
    }
}
