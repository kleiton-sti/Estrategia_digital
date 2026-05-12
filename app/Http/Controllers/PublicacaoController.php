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

            return view('produtos.artigos', compact('artigos', 'categorias', 'categoriaSlug'));
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
            $this->publicacaoService->publicar($request->validated());

            return redirect()->route('artigos.painel')->with('sucesso', 'Artigo publicado com sucesso.');
        } catch (\Throwable $e) {
            Log::error('PublicacaoController@salvar: ' . $e->getMessage());
            abort(500);
        }
    }

    public function editar(int $id): View
    {
        try {
            $artigo     = Artigo::with('categorias')->findOrFail($id);
            $categorias = $this->produtosService->listarCategorias();

            return view('publicacao.publicar', compact('artigo', 'categorias'));
        } catch (\Throwable $e) {
            Log::error('PublicacaoController@editar: ' . $e->getMessage());
            abort(500);
        }
    }

    public function atualizar(PublicacaoRequest $request, int $id): RedirectResponse
    {
        try {
            $artigo = Artigo::findOrFail($id);
            $this->publicacaoService->atualizar($artigo, $request->validated());

            return redirect()->route('artigos.conteudo', $id)->with('sucesso', 'Artigo atualizado com sucesso.');
        } catch (\Throwable $e) {
            Log::error('PublicacaoController@atualizar: ' . $e->getMessage());
            abort(500);
        }
    }

    public function excluir(int $id): RedirectResponse
    {
        try {
            $artigo = Artigo::findOrFail($id);
            $this->publicacaoService->excluir($artigo);

            return redirect()->route('artigos.painel')->with('sucesso', 'Artigo removido.');
        } catch (\Throwable $e) {
            Log::error('PublicacaoController@excluir: ' . $e->getMessage());
            abort(500);
        }
    }
}
