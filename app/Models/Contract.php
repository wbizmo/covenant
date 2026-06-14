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
}