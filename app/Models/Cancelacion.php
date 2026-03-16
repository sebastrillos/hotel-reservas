<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cancelacion extends Model
{
    protected $table = 'cancelaciones';
    public $timestamps = false;

    protected $fillable = [
        'reserva_id', 'usuario_id', 'motivo',
        'fecha_cancelacion', 'registradopor'
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}