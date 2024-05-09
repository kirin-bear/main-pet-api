<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\KirinBear\NotionDatabaseRepository;
use App\Repositories\KirinBear\NotionPageRepository;
use Carbon\Laravel\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(NotionDatabaseRepository::class);
        $this->app->singleton(NotionPageRepository::class);
    }

}
