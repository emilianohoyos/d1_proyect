<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'identification',
        'name',
        'cellphone',
        'address',
        'status',
        'document_type_id',  // Clave foránea
        'user_id',           // Clave foránea

    ];

    // Relación con DocumentType (singular, belongsTo)
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    // Relación con User (singular, belongsTo)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
