<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $table = 'habitaciones';
    public $timestamps = false;

    protected $fillable = [
        'tipo_id', 'numero', 'piso', 'capacidad',
        'descripcion', 'estado', 'imagen', 'registradopor'
    ];

    public function tipo()
    {
        return $this->belongsTo(TipoHabitacion::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'habitacion_id');
    }
}
