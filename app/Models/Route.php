<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'name'  // Único campo asignable masivamente
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'route_store');
    }
}
