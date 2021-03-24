<?php


namespace Database\Seeders;


use App\Models\User;
use App\Modules\Books\database\seeders\BookSeeder;
use Illuminate\Database\Seeder;
use JWTAuth;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
        ]);
        $token = JWTAuth::fromUser($user);
        echo $token;
    }
}
