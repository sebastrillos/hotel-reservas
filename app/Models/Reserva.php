<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';

    protected $fillable = [
        'cliente_id', 'habitacion_id', 'fecha_entrada', 'fecha_salida',
        'num_huespedes', 'total', 'estado', 'observaciones', 'registradopor'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class, 'habitacion_id');
    }

    public function cancelacion()
    {
        return $this->hasOne(Cancelacion::class, 'reserva_id');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'reserva_id');
    }
}
