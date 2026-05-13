<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';

    protected $fillable = [
        'level',
        'user',
        'ip',
        'message',
        'entity_type',
        'entity_id',
        'context',
    ];
}
