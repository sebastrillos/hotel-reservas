<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Reserva;
use App\Models\TipoHabitacion; // Asegúrate de que apunte bien a tu modelo corporativo

class Habitacion extends Model
{
    use HasFactory;

    protected $table = 'habitaciones';
    public $timestamps = false;

    protected $fillable = [
        'tipo_id', 'numero', 'piso', 'capacidad',
        'descripcion', 'estado', 'imagen', 'registradopor'
    ];

    // CAMBIAMOS EL NOMBRE AQUÍ PARA QUE EL CONTROLADOR LO ENCUENTRE
    public function tipoHabitacion()
    {
        return $this->belongsTo(TipoHabitacion::class, 'tipo_id');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'habitacion_id');
    }
}
