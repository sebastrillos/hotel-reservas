<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoHabitacion extends Model
{
    protected $table = 'tipo_habitacion';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'descripcion', 'precio_base', 'registradopor'
    ];

    public function habitaciones()
    {
        return $this->hasMany(Habitacion::class, 'tipo_id');
    }
}
