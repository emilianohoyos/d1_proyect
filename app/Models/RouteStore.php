<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteStore extends Model
{
    protected $table = 'route_store';

    protected $fillable = [
        'route_id',
        'store_id'
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function routeDetails()
    {
        return $this->hasMany(RouteDetail::class);
    }
}
