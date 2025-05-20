<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $fillable = [
        'name', // Campo asignable masivamente
    ];

    // Relación con Employee (un DocumentType tiene muchos Employees)
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
