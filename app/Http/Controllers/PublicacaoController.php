<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicacaoRequest;
use App\Models\Artigo;
use App\Services\PublicacaoService;
use App\Services\ProdutosService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use XMLWriter;

class PublicacaoController extends Controller
{
    public function __construct(
        protected PublicacaoService $publicacaoService,
        protected ProdutosService $produtosService,
    ) {
    }

    public function painel(Request $request): View
    {
        try {
            $categoriaSlug = $request->query('categoria');
            $artigos = $this->produtosService->listarArtigos($categoriaSlug);
            $categorias = $this->produtosService->listarCategorias();

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

            /* salvando em sitemap */
            $this->atualizarSitemap(true, $artigo);

            return redirect()->route('artigos.painel')->with('sucesso', 'Artigo publicado com sucesso.');
        } catch (\Throwable $e) {
            Log::error('PublicacaoController@salvar: ' . $e->getMessage());
            abort(500);
        }
    }


    public function editar(string $slug, int $id): View
    {
        try {
            $artigo = Artigo::with('categorias')->findOrFail($id);
            $categorias = $this->produtosService->listarCategorias();

            return view('publicacao.publicar', compact('artigo', 'categorias'));
        } catch (\Throwable $e) {
            Log::error('PublicacaoController@editar: ' . $e->getMessage());
            abort(500);
        }
    }

    public function atualizar(PublicacaoRequest $request, string $slug, int $id): RedirectResponse
    {
        try {
            $artigo = Artigo::findOrFail($id);

            /* deletando artigo no sitemap */
            $this->atualizarSitemap(false, $artigo);

            $publicacao = $this->publicacaoService->atualizar($artigo, $request->validated());

            /* publicar artigo no sitemap */
            $this->atualizarSitemap(true, $publicacao);

            $artigo->refresh();

            return redirect()
                ->route('artigos.conteudo', ['slug' => $artigo->slug, 'id' => $artigo->id])
                ->with('sucesso', 'Artigo atualizado com sucesso.');
        } catch (\Throwable $e) {
            Log::error('PublicacaoController@atualizar: ' . $e->getMessage());
            abort(500);
        }
    }

    public function excluir(string $slug, int $id): RedirectResponse
    {
        try {
            $artigo = Artigo::findOrFail($id);
            $this->publicacaoService->excluir($artigo);

            /* deletando artigo no sitemap */
            $this->atualizarSitemap(false, $artigo);

            return redirect()->route('artigos.painel')->with('sucesso', 'Artigo removido.');
        } catch (\Throwable $e) {
            Log::error('PublicacaoController@excluir: ' . $e->getMessage());
            abort(500);
        }
    }

    private function atualizarSitemap(bool $atualizar, Artigo $artigo): void
    {
        if ($atualizar === true) {

            $baseUrl = rtrim(config('app.url', 'https://estrategiadigital.caraguatatuba.sp.gov.br'), '/');
            $xml = simplexml_load_file(base_path('storage/sitemap.xml'));

            $existe = false;

            foreach ($xml->url as $url) {

                if ($url->loc == $baseUrl . $artigo->slug) {
                    $existe = true;
                }

            }

            if (!$existe) {
                $url = $xml->addChild('url');
                $url->addChild('loc', $baseUrl . $artigo->slug);
                $url->addChild('lastmod', $artigo->updated_at->toAtomString());

                $xml->asXML(storage_path('sitemap.xml'));
            }

        }
        else {
            $xml = simplexml_load_file(base_path('storage/sitemap.xml'));

            foreach ($xml->url as $url) {
                if ($url->loc == $artigo->slug) {
                    $url->parent->remove();
                }
            }

            $xml->asXML(storage_path('sitemap.xml'));
        }
    }

}
