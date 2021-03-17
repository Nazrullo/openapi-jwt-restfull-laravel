<?php

namespace App\Modules\Books\Providers;

use App\Modules\Books\Repository\BookReadRepository;
use App\Modules\Books\Repository\BookReadRepositoryInterface;
use App\Modules\Books\Repository\BookWriteRepository;
use App\Modules\Books\Repository\BookWriteRepositoryInterface;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use Route;

class BookServiceProvider extends ServiceProvider
{

    protected $namespace = 'App\Modules\Books\Controllers';
    protected $apiPrefix = '/api/v1/';

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
        $this->app->bind(BookWriteRepositoryInterface::class, BookWriteRepository::class);
        $this->app->bind(BookReadRepositoryInterface::class, BookReadRepository::class);
    }


    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'book'
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
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../routes/route.php');
    }


}
