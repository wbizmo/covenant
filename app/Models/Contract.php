<?php

namespace App\Models;

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

        if (now()->diffInDays($this->end_date, false) <= 30) {
            return 'expiring';
        }

        return 'active';
    }

    public function getRenewalCountdownAttribute(): string
    {
        if (!$this->renewal_date) {
            return 'No renewal date';
        }

        $days = now()->startOfDay()->diffInDays(
            $this->renewal_date->startOfDay(),
            false
        );

        if ($days < 0) {
            return 'Renewal passed '.abs($days).' days ago';
        }

        if ($days === 0) {
            return 'Renews today';
        }

        if ($days === 1) {
            return 'Renews tomorrow';
        }

        return 'Renews in '.$days.' days';
    }
}