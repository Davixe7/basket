<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Player;

class PlayerControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test para obtener todos los jugadores.
     *
     * @return void
     */
    public function testGetAllPlayers()
    {
        $response = $this->get('/api/players');

        $response->assertStatus(200);
        $response->assertJsonCount(Player::count());
    }

    /**
     * Test para crear un nuevo jugador.
     *
     * @return void
     */
    public function testCreatePlayer()
    {
        $playerData = [
            'number' => 23,
            'name' => 'Michael Jordan',
            'height' => 6.6,
            'position' => '2',
            'weight' => 216,
            'phone' => '1234567890',
        ];

        $response = $this->post('/api/players', $playerData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('players', $playerData);
    }

    /**
     * Test para actualizar un jugador existente.
     *
     * @return void
     */
    public function testUpdatePlayer()
    {
        $player = Player::factory()->create();

        $updatedPlayerData = [
            'number' => 24,
            'name' => 'Kobe Bryant',
            'height' => 6.8,
            'position' => '2',
            'weight' => 212,
            'phone' => '9876543210',
        ];

        $response = $this->put('/api/players/' . $player->id, $updatedPlayerData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('players', $updatedPlayerData);
    }

    /**
     * Test para eliminar un jugador existente.
     *
     * @return void
     */
    public function testDeletePlayer()
    {
        $player = Player::factory()->create();

        $response = $this->delete('/api/players/' . $player->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('players', ['id' => $player->id]);
    }
}
