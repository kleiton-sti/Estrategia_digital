<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadService
{
    public function salvarImagem(UploadedFile $arquivo): string
    {
        try {
            $nome = Str::uuid() . '.' . $arquivo->getClientOriginalExtension();
            $arquivo->storeAs('/artigos', $nome);

            return asset('storage/artigos/' . $nome);
        } catch (\Throwable $e) {
            Log::error('Erro ao salvar imagem: ' . $e->getMessage());
            throw $e;
        }
    }
}
