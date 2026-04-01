<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'title', 'subtitle', 'body', 'meta',
        'hero_image', 'meta_title', 'meta_description',
        'sort_order', 'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'meta'   => 'array',
    ];

    // ── Scopes ───────────────────────────────────────────────
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    // ── Helpers ───────────────────────────────────────────────
    public static function findBySlug(string $slug): ?self
    {
        return static::where('slug', $slug)->first();
    }

    public function heroImageUrl(): ?string
    {
        return $this->hero_image ? asset('storage/' . $this->hero_image) : null;
    }
}