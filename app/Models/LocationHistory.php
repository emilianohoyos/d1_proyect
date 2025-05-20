<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationHistory extends Model
{
    protected $fillable = [
        'latitud',
        'longitud',
        'visit_date',
        'route_details_stores_id'
    ];

    protected $casts = [
        'visit_date' => 'datetime'
    ];

    public function routeDetailsStore()
    {
        return $this->belongsTo(RouteDetail::class, 'route_details_stores_id');
    }
}
