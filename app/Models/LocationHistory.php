<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationHistory extends Model
{
    protected $fillable = [
        'latitude',
        'longitude',
        'visit_date',
        'employee_id',
        'transaction_type'
    ];

    protected $casts = [
        'visit_date' => 'datetime'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
