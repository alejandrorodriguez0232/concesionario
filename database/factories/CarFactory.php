<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'marca' => $this->faker->randomElement(['Toyota', 'Honda', 'Ford', 'Chevrolet', 'Volkswagen']),
            'modelo' => $this->faker->word,
            'año' => $this->faker->numberBetween(2000, 2023),
            'color' => $this->faker->colorName,
            'precio' => $this->faker->numberBetween(5000, 50000),
            'kilometraje' => $this->faker->numberBetween(0, 200000),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}