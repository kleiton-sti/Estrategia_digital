<?php

namespace App\Http\Controllers;

use App\Models\Eixo;
use App\Services\ProdutosService;
use Illuminate\Support\Facades\Log;

class ProdutosController extends Controller
{
    public function __construct(protected ProdutosService $produtosService) {}

    public function numeros()
    {
        try {
            $eixos = Eixo::with(['roadmaps' => function ($query) {
                $query->orderByRaw("FIELD(status, 'entregue_recentemente', 'em_andamento', 'explorando')");
            }])->get();

            return view('produtos.stii', compact('eixos'));
        } catch (\Throwable $e) {
            Log::error('Erro em numeros: ' . $e->getMessage());
            abort(500);
        }
    }

    public function allHands()
    {
        try {
            $eixos = Eixo::with(['roadmaps' => function ($query) {
                $query->orderByRaw("FIELD(status, 'entregue_recentemente', 'em_andamento', 'explorando')");
            }])->get();

            return view('produtos.hands', compact('eixos'));
        } catch (\Throwable $e) {
            Log::error('Erro em allHands: ' . $e->getMessage());
            abort(500);
        }
    }

    public function artigos()
    {
        try {
            $artigos    = $this->produtosService->listarArtigos();
            $categorias = $this->produtosService->listarCategorias();

            return view('produtos.artigos', compact('artigos', 'categorias'));
        } catch (\Throwable $e) {
            Log::error('Erro ao exibir artigos: ' . $e->getMessage());
            abort(500);
        }
    }

    public function conteudoArtigo(int $id)
    {
        try {
            $artigo = $this->produtosService->buscarArtigo($id);

            return view('produtos.conteudo-artigo', compact('artigo'));
        } catch (\Throwable $e) {
            Log::error('Erro ao exibir conteúdo do artigo: ' . $e->getMessage());
            abort(500);
        }
    }
}
