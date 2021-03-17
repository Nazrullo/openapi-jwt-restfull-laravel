<?php


namespace App\Modules\Authors\database\seeders;


use App\Modules\Authors\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        Author::factory(10)->create();
    }

}
