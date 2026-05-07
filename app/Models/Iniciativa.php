<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iniciativa extends Model
{
    use HasFactory;

    protected $table = 'iniciativas';
    protected $primaryKey = 'id_iniciativa';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'codigo',
        'titulo',
        'descricao',
        'status',
        'id_objetivo',
    ];

    public function objetivo()
    {
        return $this->belongsTo(Objetivo::class, 'id_objetivo', 'id_objetivo');
    }
}
