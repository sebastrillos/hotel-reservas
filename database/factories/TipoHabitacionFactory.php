<?php

namespace Database\Factories;

use App\Models\TipoHabitacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TipoHabitacion>
 */
class TipoHabitacionFactory extends Factory
{


public function definition(): array
{
    return [
        'nombre' => $this->faker->randomElement(['Simple', 'Doble', 'Suite', 'Familiar']),
        'descripcion' => $this->faker->sentence(),
        'precio_base' => $this->faker->randomFloat(2, 80000, 400000),
        'registradopor' => 'admin',
    ];
}
}
