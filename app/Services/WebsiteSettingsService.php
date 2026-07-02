<?php

namespace App\Services;

use App\Support\Settings;
use Illuminate\Http\UploadedFile;

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

        $values['site_logo_url'] = Settings::get('site_logo_url');
        $values['site_favicon_url'] = Settings::get('site_favicon_url');

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
            Settings::set('site_logo_url', asset('storage/'.$path));
        }

        if ($favicon) {
            $path = $this->imageUploadService->upload($favicon, 'settings', maxWidth: 256);
            Settings::set('site_favicon_url', asset('storage/'.$path));
        }
    }
}
