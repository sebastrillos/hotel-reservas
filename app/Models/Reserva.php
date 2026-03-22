<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserva extends Model
{
    use HasFactory;
    
    protected $table = 'reservas';

    protected $fillable = [
        'cliente_id', 'habitacion_id', 'fecha_entrada', 'fecha_salida',
        'num_huespedes', 'total', 'estado', 'observaciones', 'registradopor'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
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
