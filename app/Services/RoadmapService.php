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
                $q->orderByRaw("CASE status WHEN 'entregue_recentemente' THEN 0 WHEN 'em_andamento' THEN 1 WHEN 'explorando' THEN 2 ELSE 3 END");
            }])->get();
        } catch (\Throwable $e) {
            Log::error('Erro ao listar roadmap: ' . $e->getMessage());
            abort(500);
        }
    }
}
