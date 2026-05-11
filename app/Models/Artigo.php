<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artigo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'artigos';

    protected $fillable = [
        'user_id',
        'titulo',
        'subtitulo',
        'corpo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'artigo_categoria');
    }
}
