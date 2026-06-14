<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProcurementRequest extends Model
{
    use HasUuids;

    protected $fillable = [
        'sppg_id',
        'kategori_produk',
        'jumlah_kebutuhan',
        'satuan',
        'harga_maksimal',
        'radius_km',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi_kebutuhan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_kebutuhan' => 'decimal:2',
            'radius_km' => 'decimal:2',
        ];
    }

    public function sppg(): BelongsTo
    {
        return $this->belongsTo(Sppg::class, 'sppg_id');
    }

    public function matchingResults(): HasMany
    {
        return $this->hasMany(MatchingResult::class);
    }
}
