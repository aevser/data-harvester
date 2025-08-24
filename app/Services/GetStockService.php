<?php

namespace App\Services;

use App\Abstracts\BaseApiService;
use App\Models\Stock;

class GetStockService extends BaseApiService
{
    private const string STOCKS_URL = 'http://109.73.206.144:6969/api/stocks';

    protected function getUrl(): string
    {
        return self::STOCKS_URL;
    }

    protected function validateItem(array $item): bool
    {
        return !empty($item['barcode']) && !empty($item['warehouse_name']);
    }

    protected function saveItem(array $item): void
    {
        Stock::query()->create($item);
    }

    public function setStocks(): bool
    {
        return $this->fetchData(current_date: true);
    }
}
