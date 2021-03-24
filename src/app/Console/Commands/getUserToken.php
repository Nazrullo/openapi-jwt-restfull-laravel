<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use JWTAuth;
class getUserToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $token = JWTAuth::attempt(['email'=>'admin@mail.com','password'=>'admin']);
        dd($token);

        return 0;
    }
}
