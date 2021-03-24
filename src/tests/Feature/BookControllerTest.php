<?php

namespace Tests\Feature;

use App\Modules\Authors\Models\Author;
use App\Modules\Books\Models\Books;
use Illuminate\Http\Response;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    protected $perefix = '/api/v1/';

    public function testShow()
    {
        $book = Books::first('id');
        $this->json('get', $this->perefix . 'book/' . $book->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'message',
                    'data' => [
                        'id',
                        'name',
                        'description',
                        'authors' => [
                            '*' => [
                                'id',
                                'full_name',
                                'about',
                                'birth_date'
                            ]
                        ]
                    ]
                ]
            );
    }
    public function testStore()
    {
        $payload = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
        ];
        $this->json('post', $this->perefix . 'book', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'message',
                    'data' => [
                        'id',
                        'name',
                        'description',
                    ]
                ]
            );
        $this->assertDatabaseHas('books', $payload);
    }

    public function testUpdate()
    {
        $this->withHeader('Accept','application/x-www-form-urlencoded');
        $book = Books::first('id');
        $payload = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
        ];
        $this->json('put', $this->perefix . 'book/' . $book->id, $payload)
            ->assertStatus(Response::HTTP_ACCEPTED)
            ->assertJsonStructure(
                [
                    'message',
                    'data' => [
                        'id',
                        'name',
                        'description',
                        'authors' => [
                            '*' => [
                                'id',
                                'full_name',
                                'about',
                                'birth_date'
                            ]
                        ]
                    ]
                ]
            );
        $this->assertDatabaseHas('books', $payload);
    }

    public function testIndex()
    {
        $this->json('get', $this->perefix . 'book')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'message',
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'description',
                        ]
                    ]
                ]
            );
    }

//
    public function testGetBooksByAuthorId()
    {
        $author = Author::first('id');
        $this->json('get', $this->perefix . 'book/getBooksByAuthorId/' . $author->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'message',
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'description',
                        ]
                    ]
                ]
            );
    }

}
