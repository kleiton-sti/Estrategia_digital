<?php

namespace App\Services;

use App\Models\Artigo;
use App\Models\Categoria;
use Illuminate\Support\Facades\Log;

class ProdutosService
{
    public function listarArtigos()
    {
        try {
            return Artigo::with(['categorias', 'user'])->latest()->get();
        } catch (\Throwable $e) {
            Log::error('ProdutosService@listarArtigos: ' . $e->getMessage());
            abort(500);
        }
    }

    public function listarCategorias()
    {
        try {
            return Categoria::all();
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
}
