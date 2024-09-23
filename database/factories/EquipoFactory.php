<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipo>
 */
class EquipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake() ->word(),
            'marca' => fake() ->word(),
            'modelo' => fake() ->word(),
            'serie' => fake() ->numberBetween(1, 50000)
        ];
    }
}
