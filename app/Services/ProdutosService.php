<?php

namespace App\Services;

use App\Models\Artigo;
use App\Models\Categoria;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class ProdutosService
{
    public function listarArtigos(?string $categoriaSlug = null): LengthAwarePaginator
    {
        try {
            $query = Artigo::with(['categorias', 'user'])->latest();

            if ($categoriaSlug) {
                $query->whereHas('categorias', function ($q) use ($categoriaSlug) {
                    $q->whereRaw('LOWER(REPLACE(nome, " ", "-")) = ?', [$categoriaSlug]);
                });
            }

            return $query->paginate(6)->withQueryString();
        } catch (\Throwable $e) {
            Log::error('ProdutosService@listarArtigos: ' . $e->getMessage());
            abort(500);
        }
    }

    public function listarCategorias()
    {
        try {
            return Categoria::orderBy('nome')->get();
        } catch (\Throwable $e) {
            Log::error('ProdutosService@listarCategorias: ' . $e->getMessage());
            abort(500);
        }
    }

    public function buscarArtigo(int $id): Artigo
    {
        try {
            return Artigo::with(['categorias', 'user'])->findOrFail($id);
        } catch (\Throwable $e) {
            Log::error('ProdutosService@buscarArtigo: ' . $e->getMessage());
            abort(500);
        }
    }

    public function buscarArtigoPorSlug(string $slug): Artigo
    {
        try {
            return Artigo::with(['categorias', 'user'])->where('slug', $slug)->firstOrFail();
        } catch (\Throwable $e) {
            Log::error('ProdutosService@buscarArtigoPorSlug: ' . $e->getMessage());
            abort(404);
        }
    }
}
