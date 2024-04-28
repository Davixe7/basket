<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Player;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $players = [
            [
                'name' => 'Angel Rodriguez',
                'number' => 12,
                'position' => 5,
            ],
            [
                'name' => 'César Maturet',
                'number' => 14,
                'position' => 5,
            ],
            [
                'name' => 'Daniel Marcano',
                'number' => 2,
                'position' => 3,
            ],
            [
                'name' => 'David Guilarte',
                'number' => 10,
                'position' => 2,
            ],
            [
                'name' => 'Erick Velásquez',
                'number' => 6,
                'position' => 1,
            ],
            [
                'name' => 'Fran Arrioja Jr',
                'number' => 8,
                'position' => 1,
            ],
            [
                'name' => 'José Rivera',
                'number' => 24,
                'position' => 4,
            ],
            [
                'name' => 'Juan Serrano',
                'number' => 13,
                'position' => 3,
            ],
            [
                'name' => 'Julio Regalado',
                'number' => 5,
                'position' => 4,
            ],
            [
                'name' => 'Junior Salazar',
                'number' => 22,
                'position' => 4,
            ],
            [
                'name' => 'Kedir Cedeño',
                'number' => 4,
                'position' => 1,
            ],
            [
                'name' => 'Samuel Quijada',
                'number' => 3,
                'position' => 1,
            ],
            [
                'name' => 'Peter Figueroa',
                'number' => 1,
                'position' => 2,
            ],
            [
                'name' => 'Kelvin Delgado',
                'number' => 11,
                'position' => 5,
            ],
        ];

        foreach( $players as $player ){
            Player::create($player);
        }
    }
}
