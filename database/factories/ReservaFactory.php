<?php

namespace Database\Factories;

use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Habitacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reserva>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
{
    $entrada = $this->faker->dateTimeBetween('-1 month', 'now');
    $salida = $this->faker->dateTimeBetween($entrada, '+10 days');

    return [
        'cliente_id' => $this->faker->randomElement(Cliente::pluck('id')->toArray()),
        'habitacion_id' => $this->faker->randomElement(Habitacion::pluck('id')->toArray()),
        'fecha_entrada' => $entrada,
        'fecha_salida' => $salida,
        'num_huespedes' => $this->faker->numberBetween(1, 5),
        'total' => $this->faker->randomFloat(2, 100000, 1000000),
        'estado' => $this->faker->randomElement(['pendiente', 'confirmada', 'cancelada']),
        'observaciones' => $this->faker->sentence(),
        'registradopor' => 'admin',
    ];
}
}
