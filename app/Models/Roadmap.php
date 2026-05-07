<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    use HasFactory;

    protected $table = 'roadmap';

    protected $fillable = [
        'acao',
        'status',
        'eixo_id',
    ];

    // Relacionamento com eixo
    public function eixo()
    {
        return $this->belongsTo(Eixo::class);
    }
}
