<?php

declare(strict_types=1);

namespace App\Providers;

use App\UseCases\Alisa\HandleRequestUseCase;
use App\UseCases\Finance\InvoiceMonthIndexUseCase;
use App\UseCases\Memory\MemoryIndexUseCase;
use App\UseCases\Memory\MemoryLinkIndexUseCase;
use App\UseCases\Notion\DatabasesSyncUseCase;
use App\UseCases\Storage\UploadFileUseCase;
use App\UseCases\User\UserInformationGetUseCase;
use App\UseCases\User\UserRegistrationUseCase;
use App\UseCases\Visit\VisitStoreUseCase;
use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // alisa
        $this->app->singleton(HandleRequestUseCase::class);

        // finance
        $this->app->singleton(InvoiceMonthIndexUseCase::class);

        // memory
        $this->app->singleton(MemoryIndexUseCase::class);
        $this->app->singleton(MemoryLinkIndexUseCase::class);

        // notion
        $this->app->singleton(DatabasesSyncUseCase::class);

        // storage
        $this->app->singleton(UploadFileUseCase::class);

        // user
        $this->app->singleton(UserInformationGetUseCase::class);
        $this->app->singleton(UserRegistrationUseCase::class);

        // visit
        $this->app->singleton(VisitStoreUseCase::class);

    }

}
