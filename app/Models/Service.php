<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'short_desc', 'description',
        'image', 'is_featured', 'sort_order', 'active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'active'      => 'boolean',
    ];

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

    // ── Helpers ───────────────────────────────────────────────
    public function imageUrl(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}