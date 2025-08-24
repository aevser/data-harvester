<?php

namespace App\Console\Commands;

use App\Services\GetOrderService;
use Illuminate\Console\Command;

class GetOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получить данные о заказах';

    /**
     * Execute the console command.
     */
    public function handle(GetOrderService $getOrderService): void
    {
        $orders = $getOrderService->setOrders();

        if ($orders) { $this->info('Данные о заказах успешно получены.'); }
    }
}
