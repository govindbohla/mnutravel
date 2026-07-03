<?php

namespace App\Services;

use App\Support\Settings;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class WebsiteSettingsService
{
    /**
     * Keys managed by the Website Settings admin screen.
     */
    public const KEYS = [
        'site_name',
        'site_tagline',
        'whatsapp_number',
        'admin_notification_email',
        'primary_phone',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'youtube_url',
        'footer_about',
        'footer_copyright',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function __construct(protected ImageUploadService $imageUploadService)
    {
    }

    public function all(): array
    {
        $values = [];

        foreach (self::KEYS as $key) {
            $values[$key] = Settings::get($key);
        }

        $values['site_logo_url'] = $this->toAbsoluteUrl(Settings::get('site_logo_url'));
        $values['site_favicon_url'] = $this->toAbsoluteUrl(Settings::get('site_favicon_url'));

        return $values;
    }

    public function update(array $data, ?UploadedFile $logo, ?UploadedFile $favicon): void
    {
        foreach (self::KEYS as $key) {
            if (array_key_exists($key, $data)) {
                Settings::set($key, $data[$key]);
            }
        }

        if ($logo) {
            $path = $this->imageUploadService->upload($logo, 'settings', maxWidth: 600);
            Settings::set('site_logo_url', 'storage/'.$path);
        }

        if ($favicon) {
            $path = $this->imageUploadService->upload($favicon, 'settings', maxWidth: 256);
            Settings::set('site_favicon_url', 'storage/'.$path);
        }
    }

    /**
     * Settings store either a relative path (resolved against the current
     * APP_URL/domain at render time) or an already-absolute URL (e.g. a
     * legacy value or an external CDN link) — never bake a domain in early.
     */
    protected function toAbsoluteUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        return Str::startsWith($path, ['http://', 'https://']) ? $path : asset($path);
    }
}
