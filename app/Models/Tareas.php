<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    protected $fillable = ['referencia', 'nombre', 'descripcion', 'fecha', 'estado'];
}

