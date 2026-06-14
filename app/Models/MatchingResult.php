<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchingResult extends Model
{
    use HasUuids;

    protected $fillable = [
        'procurement_request_id',
        'supplier_id',
        'distance_km',
        'distance_score',
        'capacity_score',
        'document_score',
        'history_score',
        'total_score',
        'ranking',
    ];

    protected function casts(): array
    {
        return [
            'distance_km' => 'decimal:3',
            'distance_score' => 'decimal:4',
            'capacity_score' => 'decimal:4',
            'document_score' => 'decimal:4',
            'history_score' => 'decimal:4',
            'total_score' => 'decimal:4',
            'ranking' => 'integer',
        ];
    }

    public function procurementRequest(): BelongsTo
    {
        return $this->belongsTo(ProcurementRequest::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
