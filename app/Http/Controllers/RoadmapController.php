<?php

namespace App\Http\Controllers;

use App\Services\RoadmapService;
use Illuminate\Support\Facades\Log;

class RoadmapController extends Controller
{
    public function __construct(protected RoadmapService $roadmapService) {}

    public function index()
    {
        try {
            $eixos = $this->roadmapService->listarEixosComRoadmap();

            return view('roadmap', compact('eixos'));
        } catch (\Throwable $e) {
            Log::error('Erro ao carregar roadmap: ' . $e->getMessage());
            return view('error.error500');
        }
    }
}
