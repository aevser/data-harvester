<?php

namespace App\Console\Commands;

use App\Services\GetSaleService;
use Illuminate\Console\Command;

class GetSale extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-sales';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получить данные о продажах';

    /**
     * Execute the console command.
     */
    public function handle(GetSaleService $getSaleService): void
    {
        $sales = $getSaleService->setSales();

        if ($sales) { $this->info('Данные о продажах успешно получены.'); }
    }
}
