<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run()
    {
        // Crear un usuario específico para los autos
        $user = User::factory()->create([
            'name' => 'Usuario de Autos',
            'email' => 'autos@example.com',
            'password' => bcrypt('password'),
        ]);

        // Crear 20 autos asociados a este usuario
        Car::factory()
            ->count(20)
            ->create([
                'user_id' => $user->id,
            ]);
    }
}