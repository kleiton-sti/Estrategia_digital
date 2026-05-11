<?php

namespace App\Services;

use App\Models\Artigo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PublicacaoService
{
    public function publicar(array $dados): Artigo
    {
        try {
            return Artigo::create([
                'user_id'      => Auth::id(),
                'categoria_id' => $dados['categoria_id'],
                'titulo'       => $dados['titulo'],
                'subtitulo'    => $dados['subtitulo'],
                'corpo'        => $dados['corpo'],
            ]);
        } catch (\Throwable $e) {
            Log::error('Erro ao publicar artigo: ' . $e->getMessage());
            abort(500);
        }
    }

    public function atualizar(Artigo $artigo, array $dados): void
    {
        try {
            $artigo->update([
                'categoria_id' => $dados['categoria_id'],
                'titulo'       => $dados['titulo'],
                'subtitulo'    => $dados['subtitulo'],
                'corpo'        => $dados['corpo'],
            ]);
        } catch (\Throwable $e) {
            Log::error('Erro ao atualizar artigo: ' . $e->getMessage());
            abort(500);
        }
    }

    public function excluir(Artigo $artigo): void
    {
        try {
            $artigo->delete();
        } catch (\Throwable $e) {
            Log::error('Erro ao excluir artigo: ' . $e->getMessage());
            abort(500);
        }
    }

}
