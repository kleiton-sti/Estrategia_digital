<?php

namespace App\Http\Controllers;

use App\Models\Eixo;

class PlanoDiretorController extends Controller
{
    public function plano()
    {
        // Pega todos os eixos com seus roadmap ordenados por status
        $eixos = Eixo::with(['roadmaps' => function ($query) {
            $query->orderByRaw("FIELD(status, 'entregue_recentemente', 'em_andamento', 'explorando')");
        }])->get();

        return view('planodiretor.plano', compact('eixos'));
    }
}
