<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     *
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->sentence(),
            'descripcion'=> $this->faker->paragraph(),
            'categoria'=> $this->faker->randomElement(['programador','desarrollador']),
        ];
    }
}
