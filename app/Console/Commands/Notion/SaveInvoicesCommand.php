<?php

declare(strict_types=1);

namespace App\Console\Commands\Notion;

use App\UseCases\Notion\SaveInvoicesUseCase;
use Illuminate\Console\Command;

class SaveInvoicesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notion:save-invoices {userId}'; // ex: notion:save-invoices 1

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Сохранение агрегированных данных в invoice';

    public function handle(SaveInvoicesUseCase $useCase): void
    {
        $useCase->execute((int)$this->argument('userId'));
    }


}
