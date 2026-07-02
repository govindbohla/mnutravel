<?php

namespace App\View\Composers;

use App\Models\ContactDetail;
use App\Models\Menu;
use App\Models\Vehicle;
use App\Support\Settings;
use Illuminate\View\View;

class FrontLayoutComposer
{
    /**
     * Memoized per-request so the underlying queries only run once even
     * though this composer is bound to every front.* view (the layout
     * plus every header/footer/modal partial it includes).
     */
    protected static ?array $data = null;

    public function compose(View $view): void
    {
        $view->with(self::$data ??= $this->resolve());
    }

    protected function resolve(): array
    {
        $headerMenu = Menu::where('location', 'header')->with(['items' => function ($query) {
            $query->where('status', 'active')->with(['children' => function ($query) {
                $query->where('status', 'active')->with('page');
            }, 'page']);
        }])->first();

        $footerMenu = Menu::where('location', 'footer')->with(['items' => function ($query) {
            $query->where('status', 'active')->with('page');
        }])->first();

        return [
            'headerMenuItems' => $headerMenu?->items ?? collect(),
            'footerMenuItems' => $footerMenu?->items ?? collect(),
            'siteContactDetail' => ContactDetail::first(),
            'bookingModalVehicles' => Vehicle::active()->orderBy('name')->get(),
            'siteSettings' => [
                'site_name' => Settings::get('site_name', 'MNU Travels'),
                'site_tagline' => Settings::get('site_tagline'),
                'site_logo_url' => Settings::get('site_logo_url', asset('assets/img/logo.png')),
                'site_favicon_url' => Settings::get('site_favicon_url', asset('assets/img/logo.png')),
                'whatsapp_number' => Settings::get('whatsapp_number', '+91XXXXXXXXXX'),
                'primary_phone' => Settings::get('primary_phone'),
                'facebook_url' => Settings::get('facebook_url'),
                'instagram_url' => Settings::get('instagram_url'),
                'twitter_url' => Settings::get('twitter_url'),
                'youtube_url' => Settings::get('youtube_url'),
                'footer_about' => Settings::get('footer_about'),
                'footer_copyright' => Settings::get('footer_copyright', '&copy; '.date('Y').' MNU Travels. All rights reserved.'),
                'meta_title' => Settings::get('meta_title', 'MNU Travels'),
                'meta_description' => Settings::get('meta_description'),
                'meta_keywords' => Settings::get('meta_keywords'),
            ],
        ];
    }
}
