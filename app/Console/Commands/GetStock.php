<?php

namespace App\Console\Commands;

use App\Services\GetStockService;
use Illuminate\Console\Command;

class GetStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-stocks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получить данные о складах';

    /**
     * Execute the console command.
     */
    public function handle(GetStockService $getStockService): void
    {
        $stocks = $getStockService->setStocks();

        if ($stocks) { $this->info('Данные о складах успешно получены.'); }
    }
}
