<?php

namespace App\Services;

use App\Models\Artigo;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PublicacaoService
{
    public function publicar(array $dados): Artigo
    {
        try {
            $artigo = Artigo::create([
                'user_id'   => Auth::id(),
                'titulo'    => $dados['titulo'],
                'subtitulo' => $dados['subtitulo'],
                'corpo'     => $dados['corpo'],
            ]);

            /* Associa as categorias via tabela associativa */
            $artigo->categorias()->sync($dados['categorias']);

            return $artigo;
        } catch (\Throwable $e) {
            Log::error('PublicacaoService@publicar: ' . $e->getMessage());
            abort(500);
        }
    }

    public function atualizar(Artigo $artigo, array $dados): void
    {
        try {
            $artigo->update([
                'titulo'    => $dados['titulo'],
                'subtitulo' => $dados['subtitulo'],
                'corpo'     => $dados['corpo'],
            ]);

            /* Sincroniza categorias — remove as desvinculadas e insere as novas */
            $artigo->categorias()->sync($dados['categorias']);
        } catch (\Throwable $e) {
            Log::error('PublicacaoService@atualizar: ' . $e->getMessage());
            abort(500);
        }
    }

    public function excluir(Artigo $artigo): void
    {
        try {
            $artigo->delete();
        } catch (\Throwable $e) {
            Log::error('PublicacaoService@excluir: ' . $e->getMessage());
            abort(500);
        }
    }

}
