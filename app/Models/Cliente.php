<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;
    
    protected $table = 'clientes';
    
    protected $fillable = [
        'nombre', 'direccion', 'email', 'documento',
        'telefono', 'estado', 'registradopor',
    ];

    protected $hidden = [
        //
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'cliente_id');
    }
}