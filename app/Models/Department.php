<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $primaryKey = 'department_id';

    public function municipalities()
    {
        return $this->hasMany(Municipality::class, 'department_id');
    }
}
