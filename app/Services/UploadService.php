<?php
 
namespace App\Services;
 
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
 
class UploadService
{
    public function salvarImagem(UploadedFile $arquivo): string
    {
        try {
            $nome = Str::uuid() . '.' . $arquivo->getClientOriginalExtension();
            $destino = public_path('uploads/artigos');
 
            if (!is_dir($destino)) {
                mkdir($destino, 0755, true);
            }
 
            $arquivo->move($destino, $nome);
 
            return asset('uploads/artigos/' . $nome);
        } catch (\Throwable $e) {
            Log::error('Erro ao salvar imagem: ' . $e->getMessage());
            throw $e;
        }
    }
}