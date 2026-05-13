<?php

namespace App\Services;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log as LaravelLog;

class LogService
{
    public function registrar(string $level, string $message, string $entityType, int $entityId, array $context = []): void
    {
        try {
            Log::create([
                'level'       => $level,
                'user'        => Auth::user()->nome ?? 'sistema',
                'ip'          => Request::ip(),
                'message'     => $message,
                'entity_type' => $entityType,
                'entity_id'   => $entityId,
                'context'     => !empty($context) ? json_encode($context) : null,
            ]);
        } catch (\Throwable $e) {
            LaravelLog::error('LogService@registrar: ' . $e->getMessage());
        }
    }
}
