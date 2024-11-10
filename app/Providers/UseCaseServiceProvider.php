<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domains\Alisa\UseCases\HandleRequestUseCase;
use App\Domains\Finance\UseCases\InvoiceMonthIndexUseCase;
use App\Domains\Memories\UseCases\MemoryIndexUseCase;
use App\Domains\Memories\UseCases\MemoryLinkIndexUseCase;
use App\Domains\Notion\UseCases\DatabasesSyncUseCase;
use App\Domains\Storage\UseCases\UploadFileUseCase;
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
