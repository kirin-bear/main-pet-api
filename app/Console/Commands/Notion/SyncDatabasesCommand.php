<?php

declare(strict_types=1);

namespace App\Console\Commands\Notion;

use App\Domains\Notion\Exceptions\ApiServiceException;
use App\UseCases\Notion\DatabasesSyncUseCase;
use Illuminate\Console\Command;
use JsonException;

class SyncDatabasesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notion:sync-databases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Синхронизация баз данных из Notion указанных в conf.php';

    /**
     * Execute the console command.
     *
     * @param DatabasesSyncUseCase $useCase
     *
     * @throws ApiServiceException
     * @throws JsonException
     */
    public function handle(DatabasesSyncUseCase $useCase): void
    {
        $databases = config('notion.sync_databases');

        $useCase->execute(... $databases);
    }

}
