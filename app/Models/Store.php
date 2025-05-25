<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name',
        'address',
        'name_charge',
        'phone_1',
        'phone_2',
        'email',
        'latitude',
        'longitude',
        'status',
        'descripcion',
        'neighborhood_id',
        'priority'
    ];

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function routes()
    {
        return $this->belongsToMany(Route::class, 'route_store');
    }

    public function routeDetails()
    {
        return $this->hasManyThrough(
            RouteDetail::class,
            RouteStore::class,
            'store_id', // Foreign key on route_store table
            'route_store_id', // Foreign key on route_details table
            'id', // Local key on stores table
            'id' // Local key on route_store table
        );
    }
}
