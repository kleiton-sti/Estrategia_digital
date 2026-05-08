<?php

namespace App\Http\Controllers;

use App\Models\Eixo;

class RoadmapController extends Controller
{
    public function index()
    {
        // Pega todos os eixos com seus roadmap ordenados por status
        $eixos = Eixo::with(['roadmaps' => function($query) {
            $query->orderByRaw("FIELD(status, 'entregue_recentemente', 'em_andamento', 'explorando')");
        }])->get();

        return view('roadmap', compact('eixos'));
    }
}
