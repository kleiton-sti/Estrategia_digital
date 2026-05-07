<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcoesInovacao extends Model
{
    protected $table = 'acoes_inovacao';

    protected $fillable = [
        'acao',
        'status_2024',
        'status_2025',
        'data_conclusao',
        'categoria'
    ];

    protected $casts = [
        'status_2024' => 'boolean',
        'status_2025' => 'integer',
    ];
}
