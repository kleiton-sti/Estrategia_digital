<?php

namespace App\Services;

use App\Models\Eixo;
use Illuminate\Support\Facades\Log;

class RoadmapService
{
    public function listarEixosComRoadmap()
    {
        try {
            return Eixo::with(['roadmaps' => function ($q) {
                $q->orderByRaw("FIELD(status, 'entregue_recentemente', 'em_andamento', 'explorando')");
            }])->get();
        } catch (\Throwable $e) {
            Log::error('Erro ao listar roadmap: ' . $e->getMessage());
            abort(500);
        }
    }
}
