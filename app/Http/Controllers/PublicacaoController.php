<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicacaoRequest;
use App\Models\Artigo;
use App\Services\PublicacaoService;
use App\Services\ProdutosService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PublicacaoController extends Controller
{
    public function __construct(
        protected PublicacaoService $publicacaoService,
        protected ProdutosService $produtosService,
    ) {}

    public function painel(): View
    {
        try {
            $artigos = $this->produtosService->listarArtigos();
            $categorias = $this->produtosService->listarCategorias();

            return view('produtos.artigos', compact('artigos', 'categorias'));
        } catch (\Throwable $e) {
            Log::error('Erro ao carregar painel: ' . $e->getMessage());
            abort(500);
        }
    }

    public function criar(): View
    {
        try {
            $categorias = $this->produtosService->listarCategorias();

            return view('publicacao.publicar', compact('categorias'));
        } catch (\Throwable $e) {
            Log::error('Erro ao exibir formulário de publicação: ' . $e->getMessage());
            abort(500);
        }
    }

    public function salvar(PublicacaoRequest $request): RedirectResponse
    {
        try {
            $this->publicacaoService->publicar($request->validated());

            return redirect()->route('artigos.painel')->with('sucesso', 'Artigo publicado com sucesso.');
        } catch (\Throwable $e) {
            Log::error('Erro ao salvar artigo: ' . $e->getMessage());
            abort(500);
        }
    }

    public function editar(int $id): View
    {
        try {
            $artigo     = Artigo::findOrFail($id);
            $categorias = $this->produtosService->listarCategorias();

            return view('publicacao.publicar', compact('artigo', 'categorias'));
        } catch (\Throwable $e) {
            Log::error('Erro ao carregar edição: ' . $e->getMessage());
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
            Log::error('Erro ao atualizar artigo: ' . $e->getMessage());
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
            Log::error('Erro ao excluir artigo: ' . $e->getMessage());
            abort(500);
        }
    }
}
