<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class, 'municipality_id');
    }
}
