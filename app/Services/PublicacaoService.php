<?php

namespace App\Services;

use App\Models\Artigo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PublicacaoService
{
    public function __construct(protected LogService $logService) {}

    public function publicar(array $dados): Artigo
    {
        try {
            $artigo = Artigo::create([
                'user_id'   => Auth::id(),
                'titulo'    => $dados['titulo'],
                'subtitulo' => $dados['subtitulo'],
                'corpo'     => $dados['corpo'],
            ]);

            $artigo->categorias()->sync($dados['categorias']);

            $this->logService->registrar(
                'info',
                'Artigo publicado.',
                'artigos',
                $artigo->id,
                ['titulo' => $artigo->titulo]
            );

            return $artigo;

        } catch (\Throwable $e) {
            Log::error('PublicacaoService@publicar: ' . $e->getMessage());
            abort(500);
        }
    }

    public function atualizar(Artigo $artigo, array $dados): Artigo
    {
        try {
            $artigo->update([
                'titulo'    => $dados['titulo'],
                'subtitulo' => $dados['subtitulo'],
                'corpo'     => $dados['corpo'],
            ]);

            $artigo->categorias()->sync($dados['categorias']);

            $this->logService->registrar(
                'info',
                'Artigo atualizado.',
                'artigos',
                $artigo->id,
                ['titulo' => $artigo->titulo]
            );

            return $artigo;
        } catch (\Throwable $e) {
            Log::error('PublicacaoService@atualizar: ' . $e->getMessage());
            abort(500);
        }
    }

    public function excluir(Artigo $artigo): void
    {
        try {
            $this->logService->registrar(
                'warning',
                'Artigo excluído.',
                'artigos',
                $artigo->id,
                ['titulo' => $artigo->titulo]
            );

            $artigo->delete();
        } catch (\Throwable $e) {
            Log::error('PublicacaoService@excluir: ' . $e->getMessage());
            abort(500);
        }
    }

    public function listarTodosArtigos() {
        try {
            return Artigo::all();
        } catch (\Throwable $e) {
            Log::error('PublicacaoService@listarTodosArtigos: ' . $e->getMessage());
            abort(500);
        }
    }
}
