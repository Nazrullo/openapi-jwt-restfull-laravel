<?php

namespace Tests\Feature;

use App\Modules\Authors\Controllers\AuthorController;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    protected $perefix = '/api/v1/';

    public function testStore()
    {
        $payload = [
            'full_name' => $this->faker->name,
            'birth_date' =>  "2021-03-17",
            'about' => $this->faker->text
        ];
        $this->json('post', $this->perefix . 'author', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'message',
                    'data' => [
                        'id',
                        'full_name',
                        'about',
                        'birth_date',
                    ]
                ]
            );
        $this->assertDatabaseHas('authors', $payload);
    }
}
