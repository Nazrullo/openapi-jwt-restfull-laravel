<?php

namespace Tests;

use App\Models\User;
use Exception;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use JWTAuth;
abstract class TestCase extends BaseTestCase {

    use CreatesApplication;

    private Generator $faker;
    public $token;
    public function setUp()
    : void {
        parent::setUp();
        $this->faker = Factory::create();
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->getAuthToken(),
            'Accept' => 'application/json'
        ]);
    }

    public function getAuthToken(){
        $user = User::first();
        $token = JWTAuth::fromUser($user);
        return $token;
    }

    public function __get($key) {

        if ($key === 'faker')
            return $this->faker;
        throw new Exception('Unknown Key Requested');
    }
}
