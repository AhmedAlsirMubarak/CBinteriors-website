<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'label', 'type'];

    // ── Static helpers ────────────────────────────────────────

    /**
     * Get a setting value by key, with optional default.
     * Results are cached for 1 hour.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            return static::all()->pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Set a setting value and bust the cache.
     */
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('site_settings');
    }

    /**
     * Get all settings in a given group.
     */
    public static function group(string $group): array
    {
        return static::where('group', $group)->get()->toArray();
    }

    /**
     * Get all settings keyed by group for the CMS settings page.
     */
    public static function allGrouped(): array
    {
        return static::all()
            ->groupBy('group')
            ->toArray();
    }
}