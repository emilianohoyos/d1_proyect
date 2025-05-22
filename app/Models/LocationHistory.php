<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationHistory extends Model
{
    protected $fillable = [
        'latitud',
        'longitud',
        'visit_date',
        'employee_id'
    ];

    protected $casts = [
        'visit_date' => 'datetime'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
