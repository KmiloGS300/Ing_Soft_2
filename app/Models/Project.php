<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'start_date', 'end_date', 'description']; // Asegúrate de permitir los campos correctos

    public function documents()
    {
        return $this->hasMany(Document::class); // Relación con los documentos
    }
}


