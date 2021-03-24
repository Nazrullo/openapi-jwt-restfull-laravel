<?php

namespace Database\Seeders;

use App\Modules\Authors\database\seeders\AuthorSeeder;
use App\Modules\Authors\Models\Author;
use App\Modules\Books\database\factories\BookFactory;
use App\Modules\Books\database\seeders\BookSeeder;
use App\Modules\Books\Models\Books;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BookSeeder::class);
        $this->call(UserSeeder::class);
    }
}
