<?php

namespace App\Http\Controllers;

use App\Models\Eixo;
use App\Services\ProdutosService;
use Illuminate\Http\Request;
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
            return view('error.error500');
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
            return view('error.error500');
        }
    }

    public function artigos(Request $request)
    {
        try {
            $categoriaSlug = $request->query('categoria');
            $artigos       = $this->produtosService->listarArtigos($categoriaSlug);
            $categorias    = $this->produtosService->listarCategorias();

            return view('artigos', compact('artigos', 'categorias', 'categoriaSlug'));
        } catch (\Throwable $e) {
            Log::error('Erro ao exibir artigos: ' . $e->getMessage());
            return view('error.error500');
        }
    }

    public function conteudoArtigo(string $slug)
    {
        try {
            $artigo = $this->produtosService->buscarArtigoPorSlug($slug);

            return view('produtos.conteudo-artigo', compact('artigo'));
        } catch (\Throwable $e) {
            Log::error('Erro ao exibir conteúdo do artigo: ' . $e->getMessage());
            return view('error.error500');
        }
    }
}
