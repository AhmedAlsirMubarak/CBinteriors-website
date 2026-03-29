<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'images', 'is_featured', 'sort_order', 'active',
    ];

    protected $casts = [
        'images'      => 'array',
        'price'       => 'decimal:2',
        'is_featured' => 'boolean',
        'active'      => 'boolean',
    ];

    // ── Relationships ─────────────────────────────────────────
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ── Scopes ────────────────────────────────────────────────
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('category', fn($q) => $q->where('slug', $categorySlug));
    }

    // ── Helpers ───────────────────────────────────────────────
    public function primaryImageUrl(): ?string
    {
        $images = $this->images ?? [];
        return count($images) ? asset('storage/' . $images[0]) : null;
    }

    public function allImageUrls(): array
    {
        return collect($this->images ?? [])
            ->map(fn($path) => asset('storage/' . $path))
            ->toArray();
    }

    public function formattedPrice(): string
    {
        return $this->price ? 'OMR ' . number_format($this->price, 3) : 'Price on request';
    }
}