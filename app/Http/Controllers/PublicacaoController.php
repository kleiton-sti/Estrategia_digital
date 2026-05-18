<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicacaoRequest;
use App\Models\Artigo;
use App\Services\PublicacaoService;
use App\Services\ProdutosService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PublicacaoController extends Controller
{
    public function __construct(
        protected PublicacaoService $publicacaoService,
        protected ProdutosService $produtosService,
    ) {}

    public function painel(Request $request): View
    {
        try {
            $categoriaSlug = $request->query('categoria');
            $artigos       = $this->produtosService->listarArtigos($categoriaSlug);
            $categorias    = $this->produtosService->listarCategorias();

            return view('artigos', compact('artigos', 'categorias', 'categoriaSlug'));
        } catch (\Throwable $e) {
            Log::error('PublicacaoController@painel: ' . $e->getMessage());
            abort(500);
        }
    }

    public function criar(): View
    {
        try {
            $categorias = $this->produtosService->listarCategorias();

            return view('publicacao.publicar', compact('categorias'));
        } catch (\Throwable $e) {
            Log::error('PublicacaoController@criar: ' . $e->getMessage());
            abort(500);
        }
    }

    public function salvar(PublicacaoRequest $request): RedirectResponse
    {
        try {
            $artigo = $this->publicacaoService->publicar($request->validated());

            return redirect()->route('artigos.painel')->with('sucesso', 'Artigo publicado com sucesso.');
        } catch (\Throwable $e) {
            Log::error('PublicacaoController@salvar: ' . $e->getMessage());
            abort(500);
        }
    }

    public function editar(string $slug): View
    {
        try {
            $artigo     = Artigo::with('categorias')->where('slug', $slug)->firstOrFail();
            $categorias = $this->produtosService->listarCategorias();

            return view('publicacao.publicar', compact('artigo', 'categorias'));
        } catch (\Throwable $e) {
            Log::error('PublicacaoController@editar: ' . $e->getMessage());
            abort(500);
        }
    }

    public function atualizar(PublicacaoRequest $request, string $slug): RedirectResponse
    {
        try {
            $artigo = Artigo::where('slug', $slug)->firstOrFail();
            $this->publicacaoService->atualizar($artigo, $request->validated());

            return redirect()->route('artigos.conteudo', $artigo->fresh()->slug)
                ->with('sucesso', 'Artigo atualizado com sucesso.');
        } catch (\Throwable $e) {
            Log::error('PublicacaoController@atualizar: ' . $e->getMessage());
            abort(500);
        }
    }

    public function excluir(string $slug): RedirectResponse
    {
        try {
            $artigo = Artigo::where('slug', $slug)->firstOrFail();
            $this->publicacaoService->excluir($artigo);

            return redirect()->route('artigos.painel')->with('sucesso', 'Artigo removido.');
        } catch (\Throwable $e) {
            Log::error('PublicacaoController@excluir: ' . $e->getMessage());
            abort(500);
        }
    }
}
