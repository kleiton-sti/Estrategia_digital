<?php

namespace App\Http\Controllers;

use App\Services\UploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UploadController extends Controller
{
    public function __construct(protected UploadService $uploadService) {}

    public function imagem(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'file' => ['required', 'image', 'max:4096'],
            ]);

            $url = $this->uploadService->salvarImagem($request->file('file'));

            return response()->json(['link' => $url]);
        } catch (\Throwable $e) {
            Log::error('Erro no upload de imagem: ' . $e->getMessage());
            return response()->json(['error' => 'Falha no upload.'], 500);
        }
    }
}
