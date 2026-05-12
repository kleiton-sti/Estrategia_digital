<?php

namespace App\Http\Controllers;

use App\Services\RoadmapService;
use Illuminate\Support\Facades\Log;

class PlanoDiretorController extends Controller
{
    public function __construct(protected RoadmapService $roadmapService) {}

    public function plano()
    {
        try {
            $eixos = $this->roadmapService->listarEixosComRoadmap();

            return view('planodiretor.plano', compact('eixos'));
        } catch (\Throwable $e) {
            Log::error('Erro ao carregar plano diretor: ' . $e->getMessage());
            abort(500);
        }
    }
}
