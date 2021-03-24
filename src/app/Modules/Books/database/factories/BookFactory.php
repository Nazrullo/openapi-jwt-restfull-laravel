<?php


namespace App\Modules\Books\database\factories;


use App\Modules\Authors\Models\Author;
use App\Modules\Books\Models\Books;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Books::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
    }

}
