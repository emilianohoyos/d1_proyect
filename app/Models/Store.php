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
}
