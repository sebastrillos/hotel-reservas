<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    
    protected $fillable = [
        'nombre', 'direccion', 'email', 'documento',
        'telefono', 'estado', 'registradopor'
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'cliente_id');
    }
}