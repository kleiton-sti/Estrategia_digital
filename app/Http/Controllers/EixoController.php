<?php

namespace App\Http\Controllers;

use App\Services\EixoService;
use Illuminate\Support\Facades\Log;

class EixoController extends Controller
{
    public function __construct(protected EixoService $eixoService) {}

    public function index()
    {
        try {
            return view('home', $this->eixoService->dadosHome());
        } catch (\Throwable $e) {
            Log::error('Erro ao carregar home: ' . $e->getMessage());
            abort(500);
        }
    }

    // public function show(int $id)
    // {
    //     try {
    //         return view('eixos.show', $this->eixoService->dadosEixo($id));
    //     } catch (\Throwable $e) {
    //         Log::error('Erro ao carregar eixo: ' . $e->getMessage());
    //         abort(500);
    //     }
    // }
}
