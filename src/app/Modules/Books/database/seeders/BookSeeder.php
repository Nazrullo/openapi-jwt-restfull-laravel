<?php


namespace App\Modules\Books\database\seeders;


use App\Modules\Authors\Models\Author;
use App\Modules\Books\Models\Books;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{

    public function run()
    {
        $user = Books::factory()
            ->has(Author::factory()->count(10))
            ->create();
    }

}
