<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Artigo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'artigos';

    protected $fillable = [
        'user_id',
        'titulo',
        'subtitulo',
        'corpo',
        'slug',
    ];

    /**
     * Gera slug único automaticamente ao criar ou ao mudar o título.
     */
    protected static function booted(): void
    {
        static::creating(function (Artigo $artigo) {
            $artigo->slug = static::gerarSlugUnico($artigo->titulo);
        });

        static::updating(function (Artigo $artigo) {
            if ($artigo->isDirty('titulo')) {
                $artigo->slug = static::gerarSlugUnico($artigo->titulo, $artigo->id);
            }
        });
    }

    private static function gerarSlugUnico(string $titulo, ?int $ignorarId = null): string
    {
        $base = Str::slug($titulo);
        $slug = $base;
        $i    = 1;

        $query = static::withTrashed()->where('slug', $slug);
        if ($ignorarId) {
            $query->where('id', '!=', $ignorarId);
        }

        while ($query->clone()->exists()) {
            $slug  = $base . '-' . $i++;
            $query = static::withTrashed()->where('slug', $slug);
            if ($ignorarId) {
                $query->where('id', '!=', $ignorarId);
            }
        }

        return $slug;
    }

    /**
     * Permite buscar por slug ou por id (compatibilidade).
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'artigo_categoria');
    }
}
