<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roadmap;
use App\Models\Eixo;

class RoadmapController extends Controller
{
    public function index()
    {
        $todosEixos = Eixo::select('id_eixos', 'titulo')->get();

        // Pega todos os eixos com seus roadmap ordenados por status
        $eixos = Eixo::with(['roadmaps' => function($query) {
            $query->orderByRaw("FIELD(status, 'entregue_recentemente', 'em_andamento', 'explorando')");
        }])->get();

        return view('roadmap', compact('todosEixos', 'eixos'));
    }
}
