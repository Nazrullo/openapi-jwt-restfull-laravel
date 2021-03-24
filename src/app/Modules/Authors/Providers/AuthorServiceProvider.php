<?php

namespace App\Modules\Authors\Providers;

use App\Modules\Authors\Repository\AuthorWriteRepository;
use App\Modules\Authors\Repository\AuthorWriteRepositoryInterface;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use Route;

class AuthorServiceProvider extends ServiceProvider
{

    protected $namespace = 'App\Modules\Authors\Controllers';
    protected $apiPrefix = '/api';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->routes();
        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
        }
        $this->app->bind(AuthorWriteRepositoryInterface::class, AuthorWriteRepository::class);
    }


    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'author'
        );
    }


    /**
     * Register Installment's migration files.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }


    public function routes()
    {
        Route::
        prefix($this->apiPrefix)
            ->middleware('jwt.verify')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../routes/route.php');
    }


}
