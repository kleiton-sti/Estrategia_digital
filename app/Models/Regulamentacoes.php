<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regulamentacoes extends Model
{
    protected $table = 'regulamentacoes';

    protected $fillable = [
        'titulo',
        'descricao',
        'link',
        'publicado_em',
    ];

    protected $dates = ['publicado_em'];
}
