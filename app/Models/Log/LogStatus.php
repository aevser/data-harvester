<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LogStatus extends Model
{
    protected $fillable = ['name', 'type'];

    /*
     * Вспомогательные методы
     */

    public static function getIdByType(string $type): int
    {
        return self::query()->where('type', $type)->first()->id;
    }

    /*
     * Отношения
     */

    public function logs(): HasMany
    {
        return $this->hasMany(Log::class);
    }
}
