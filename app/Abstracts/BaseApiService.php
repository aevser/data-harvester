<?php

namespace App\Abstracts;

use App\Models\Log\Log;
use App\Models\Log\LogStatus;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

abstract class BaseApiService
{
    private const string LOG_IN_PROCESS = 'in_process';
    private const string LOG_SUCCESS = 'success';
    private const string LOG_ERROR = 'error';


    protected string $api_key;
    protected const int PAGE = 1;
    protected const int LIMIT = 500;

    protected Log $current_log;

    public function __construct()
    {
        $this->api_key = config('api-key.api_key');
    }

    protected function fetchData(bool $current_date = false): bool
    {
        $this->createLog(self::LOG_IN_PROCESS, null);

        try {
            $current_page = self::PAGE;

            do {
                $data = $this->getData($current_page, $current_date);

                if (!$data || !isset($data['data']) || !isset($data['meta'])) {
                    $this->updateLog(self::LOG_ERROR, 'Не удалось получить данные от API');
                    return false;
                }

                foreach ($data['data'] as $item) {
                    if (!$this->validateItem($item)) { continue; }

                    $this->saveItem($item);
                }

                $current_page++;
            } while ($current_page <= $data['meta']['last_page']);

            $this->updateLog(self::LOG_SUCCESS, null);

            return true;
        } catch (\Exception $e) {
            $this->updateLog(self::LOG_ERROR, $e->getMessage());

            return false;
        }
    }

    protected function getData(int $page, bool $current_date): array
    {
        $response = Http::get($this->getUrl(), array_merge([
            'page' => $page,
            'key' => $this->api_key,
            'limit' => self::LIMIT
        ], $this->getDate($current_date)));

        return $response->successful() ? $response->json() : [];
    }

    protected function getDate(bool $current_date = false): array
    {
        if ($current_date) {
            return [
                'dateFrom' => Carbon::today()->format('Y-m-d'),
                'dateTo' => Carbon::now()->endOfMonth()->format('Y-m-d')
            ];
        }

        return [
            'dateFrom' => Carbon::now()->startOfMonth()->format('Y-m-d'),
            'dateTo' => Carbon::now()->endOfMonth()->format('Y-m-d')
        ];
    }

    private function updateLog(string $type, ?string $message): void
    {
        $this->current_log->update([
            'status_id' => LogStatus::getIdByType($type),
            'error_message' => $message
        ]);
    }

    private function createLog(string $type, ?string $message): void
    {
        $this->current_log = Log::query()->create([
            'status_id' => LogStatus::getIdByType($type),
            'error_message' => $message
        ]);
    }

    abstract protected function getUrl(): string;
    abstract protected function validateItem(array $item): bool;
    abstract protected function saveItem(array $item): void;
}
