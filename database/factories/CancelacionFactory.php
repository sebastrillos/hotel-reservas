<?php

namespace Database\Factories;

use App\Models\Cancelacion;
use App\Models\Reserva;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cancelacion>
 */
class CancelacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


public function definition(): array
{
    return [
        'reserva_id' => $this->faker->randomElement(\App\Models\Reserva::pluck('id')->toArray()),
        'motivo' => $this->faker->sentence(),
        'fecha_cancelacion' => $this->faker->dateTime(),
        'registradopor' => 'admin',
    ];
}
}
