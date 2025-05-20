<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteDetail extends Model
{
    protected $fillable = [
        'visit_date',
        'visit_status',
        'description',
        'real_visit_date',
        'longitude',
        'latitude',
        'route_store_id',
        'employees_id',
        'day_week',
        'week',
        'is_purchase'
    ];

    public function routeStore()
    {
        return $this->belongsTo(RouteStore::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employees_id');
    }
}
