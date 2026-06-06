<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Si tu tabla en la base de datos se llama 'clientes', Laravel la asocia automáticamente.
    protected $table = 'clientes';

    // Agrega aquí los campos de tu tabla si usas asignación masiva (ejemplo)
    protected $fillable = [
        'nombre',
        'documento',
        'telefono',
        'email'
    ];
}
