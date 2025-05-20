<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    protected $fillable = [
        'name',      // string (45)
        'status',    // boolean
        // 'created_at' y 'updated_at' NO se incluyen (se gestionan automáticamente)
    ];
}
