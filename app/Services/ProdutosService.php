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
            return Artigo::with(['categoria'])->latest()->get();
        } catch (\Throwable $e) {
            Log::error('Erro ao listar artigos: ' . $e->getMessage());
            abort(500);
        }
    }
    
    public function listarCategorias()
    {
        try {
            return Categoria::all();
        } catch (\Throwable $e) {
            Log::error('Erro ao listar categorias: ' . $e->getMessage());
            abort(500);
        }
    }


    public function buscarArtigo(int $id): Artigo
    {
        try {
            return Artigo::with(['categoria', 'user'])->findOrFail($id);
        } catch (\Throwable $e) {
            Log::error('Erro ao buscar artigo: ' . $e->getMessage());
            abort(500);
        }
    }

}
