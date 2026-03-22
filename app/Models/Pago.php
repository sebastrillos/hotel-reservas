<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pago extends Model
{
    use HasFactory;
    
    protected $table = 'pagos';
    public $timestamps = false;

    protected $fillable = [
        'reserva_id', 'monto', 'metodo_pago',
        'referencia', 'fecha_pago', 'registradopor'
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}