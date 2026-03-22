<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoHabitacion extends Model
{
    use HasFactory;
    
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
