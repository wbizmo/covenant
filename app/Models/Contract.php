<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'counterparty',
        'value',
        'start_date',
        'end_date',
        'renewal_date',
        'status',
        'document_path',
        'description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'renewal_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getCalculatedStatusAttribute(): string
    {
        if (!$this->end_date) {
            return 'active';
        }

        if ($this->end_date->isPast()) {
            return 'expired';
        }

        if (
            now()->diffInDays(
                $this->end_date,
                false
            ) <= 30
        ) {
            return 'expiring';
        }

        return 'active';
    }
}