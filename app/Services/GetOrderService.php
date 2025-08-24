<?php

namespace App\Services;

use App\Abstracts\BaseApiService;
use App\Models\Order;

class GetOrderService extends BaseApiService
{
    private const string ORDERS_URL = 'http://109.73.206.144:6969/api/orders';

    protected function getUrl(): string
    {
        return self::ORDERS_URL;
    }

    protected function validateItem(array $item): bool
    {
        return !empty($item['g_number']);
    }

    protected function saveItem(array $item): void
    {
        Order::query()->create($item);
    }

    public function setOrders(): bool
    {
        return $this->fetchData();
    }
}
