<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    use HasFactory;

    protected $table = 'objetivos';
    protected $primaryKey = 'id_objetivo';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'titulo',
        'descricao',
        'slug',
        'id_eixos',
    ];

    public function eixo()
    {
        return $this->belongsTo(Eixo::class, 'id_eixos', 'id_eixos');
    }

    public function iniciativas()
    {
        return $this->hasMany(Iniciativa::class, 'id_objetivo', 'id_objetivo');
    }
}
