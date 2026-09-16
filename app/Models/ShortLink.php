<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'user_id',
    'name',
    'code',
    'destination_url',
    'bridge_enabled',
    'qr_enabled',
    'is_active',
    'clicks_count',
])]
class ShortLink extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'bridge_enabled' => 'boolean',
            'qr_enabled' => 'boolean',
            'is_active' => 'boolean',
            'clicks_count' => 'integer',
        ];
    }

    /**
     * Relasi ke user pemilik short link.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke riwayat klik / analitik.
     */
    public function clicks(): HasMany
    {
        return $this->hasMany(LinkClick::class);
    }

    /**
     * Helper accessor untuk mendapatkan full Short URL.
     */
    public function getShortUrlAttribute(): string
    {
        return url('/' . $this->code);
    }
}
