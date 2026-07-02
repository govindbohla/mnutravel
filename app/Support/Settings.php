<?php

namespace App\Support;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class Settings
{
    protected const CACHE_PREFIX = 'setting:';

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever(self::CACHE_PREFIX.$key, function () use ($key, $default) {
            return Setting::query()->where('key', $key)->value('value') ?? $default;
        });
    }

    public static function set(string $key, mixed $value): void
    {
        Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);

        Cache::forget(self::CACHE_PREFIX.$key);
    }

    public static function forget(string $key): void
    {
        Cache::forget(self::CACHE_PREFIX.$key);
    }
}
