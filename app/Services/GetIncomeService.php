<?php

namespace App\Services;

use App\Abstracts\BaseApiService;
use App\Models\Income;


class GetIncomeService extends BaseApiService
{
    private const string INCOMES_URL = 'http://109.73.206.144:6969/api/incomes';

    protected function getUrl(): string
    {
        return self::INCOMES_URL;
    }

    protected function validateItem(array $item): bool
    {
        return !empty($item['income_id']);
    }

    protected function saveItem(array $item): void
    {
        Income::query()->create($item);
    }

    public function setIncomes(): bool
    {
        return $this->fetchData();
    }
}
