<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Eixo extends Model
{
    use HasFactory;

    protected $table = 'eixos'; // nome da tabela
    protected $primaryKey = 'id_eixos'; // chave primária
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'titulo',
        'id_eixos',
        'descricao',
    ];

    public function objetivos()
    {
        return $this->hasMany(Objetivo::class, 'id_eixos', 'id_eixos');
    }

    public function roadmaps()
    {
        return $this->hasMany(Roadmap::class, 'eixo_id', 'id_eixos');
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->titulo);
    }

}
