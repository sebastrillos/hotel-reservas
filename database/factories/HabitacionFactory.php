<?php

namespace Database\Factories;

use App\Models\Habitacion;
use App\Models\TipoHabitacion; 
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<Habitacion>
 */
class HabitacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
{
    return [
        'tipo_id' => \App\Models\TipoHabitacion::inRandomOrder()->value('id') ?? \App\Models\TipoHabitacion::factory(),
        'numero' => $this->faker->unique()->numberBetween(100, 999),
        'piso' => $this->faker->numberBetween(1, 10),
        'capacidad' => $this->faker->numberBetween(1, 5),
        'descripcion' => $this->faker->sentence(),
        'estado' => $this->faker->randomElement(['disponible', 'ocupado']),
        'imagen' => 'habitacion.jpg',
        'registradopor' => 'admin',
    ];
}
}
