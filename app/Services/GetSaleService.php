<?php

namespace App\Services;


use App\Abstracts\BaseApiService;
use App\Models\Sale;

class GetSaleService extends BaseApiService
{
    private const string SALES_URL = 'http://109.73.206.144:6969/api/sales';

    protected function getUrl(): string
    {
        return self::SALES_URL;
    }

    protected function validateItem(array $item): bool
    {
        return !empty($item['g_number']);
    }

    protected function saveItem(array $item): void
    {
        Sale::query()->create($item);
    }

    public function setSales(): bool
    {
        return $this->fetchData();
    }
}
