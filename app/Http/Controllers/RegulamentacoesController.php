<?php

namespace App\Http\Controllers;

use App\Services\RegulamentacoesService;
use Illuminate\Support\Facades\Log;

class RegulamentacoesController extends Controller
{
    public function __construct(protected RegulamentacoesService $regulamentacoesService) {}

    public function index()
    {
        try {
            $regulamentacoes = $this->regulamentacoesService->listar();

            return view('regulamentacoes', compact('regulamentacoes'));
        } catch (\Throwable $e) {
            Log::error('Erro ao carregar regulamentações: ' . $e->getMessage());
            abort(500);
        }
    }
}
