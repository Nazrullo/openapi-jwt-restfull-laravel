<?php


namespace App\Modules\Authors\database\factories;


use App\Models\User;
use App\Modules\Authors\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'birth_date' => now(),
            'about' => $this->faker->text()
        ];
    }

}
