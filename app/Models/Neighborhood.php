<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    protected $fillable = [
        'name',              // string (45)
        'status',            // boolean
        'municipality_id',   // integer
        // 'created_at' y 'updated_at' NO se incluyen (se gestionan automáticamente)
    ];

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }
}
