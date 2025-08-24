<?php

namespace App\Console\Commands;

use App\Services\GetIncomeService;
use Illuminate\Console\Command;

class GetIncome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-incomes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получить данные о доходах';

    /**
     * Execute the console command.
     */
    public function handle(GetIncomeService $getIncomeService): void
    {
        $incomes = $getIncomeService->setIncomes();

        if ($incomes) { $this->info('Данные о доходах успешно поклучены.'); }
    }
}
