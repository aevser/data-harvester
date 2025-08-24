<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    protected $fillable = ['status_id', 'error_message'];

    /*
     * Отношения
     */

    public function status(): BelongsTo
    {
        return $this->belongsTo(LogStatus::class, 'status_id');
    }
}
