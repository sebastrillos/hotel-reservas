<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Authenticatable
{
    use HasFactory;
    
    protected $table = 'clientes';
    
    protected $fillable = [
        'nombre', 'direccion', 'email', 'documento',
        'telefono', 'estado', 'registradopor', 'password'
    ];

    protected $hidden = [
        'password',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'cliente_id');
    }
}