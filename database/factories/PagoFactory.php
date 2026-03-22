<?php

namespace Database\Factories;

use App\Models\Pago;
use App\Models\Reserva;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pago>
 */
class PagoFactory extends Factory
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
        'monto' => $this->faker->randomFloat(2, 50000, 500000),
        'metodo_pago' => $this->faker->randomElement(['efectivo', 'tarjeta']),
        'referencia' => $this->faker->uuid(),
        'fecha_pago' => $this->faker->dateTime(),
        'registradopor' => 'admin',
    ];
}
}
