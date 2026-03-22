<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoHabitacion;
use App\Models\Habitacion;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Reserva;
use App\Models\Pago;
use App\Models\Cancelacion;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tipos de habitación
        TipoHabitacion::factory(10)->create();

        // 2. Habitaciones
        Habitacion::factory(20)->create();

        // 3. Clientes con reservas y pagos relacionados
        $clientes = Cliente::factory(20)
            ->has(
                Reserva::factory()
                    ->count(3)
                    ->has(
                        Pago::factory()->count(1)
                    )
            )
            ->create();

        // 4. Obtener todas las reservas creadas
        $reservas = Reserva::all();

        // 5. Cancelar algunas reservas aleatoriamente (máximo 10)
        $reservasCanceladas = $reservas->random(min(10, $reservas->count()));

        foreach ($reservasCanceladas as $reserva) {

            // Crear cancelación relacionada
            Cancelacion::factory()->create([
                'reserva_id' => $reserva->id
            ]);

            // Actualizar estado de la reserva
            $reserva->update([
                'estado' => 'cancelada'
            ]);
        }
    }
}
