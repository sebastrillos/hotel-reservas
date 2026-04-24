<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Cliente>
 */
class ClienteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'direccion' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'documento' => $this->faker->unique()->numerify('##########'),
            'telefono' => $this->faker->phoneNumber(),
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
            'registradopor' => 'admin',
        ];
    }
}
