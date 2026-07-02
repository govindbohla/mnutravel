<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $headerMenu = Menu::query()->updateOrCreate(['location' => 'header'], ['name' => 'Header Menu']);
        $footerMenu = Menu::query()->updateOrCreate(['location' => 'footer'], ['name' => 'Footer Menu']);

        $aboutPage = Page::query()->where('slug', 'about-us')->first();
        $privacyPage = Page::query()->where('slug', 'privacy-policy')->first();
        $termsPage = Page::query()->where('slug', 'terms-and-conditions')->first();

        $headerItems = [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'About Us', 'url' => null, 'page_id' => $aboutPage?->id],
            ['label' => 'Our Cars', 'url' => '/our-cars'],
            ['label' => 'Services', 'url' => '/services'],
            ['label' => 'Tour Packages', 'url' => '/tour-packages'],
            ['label' => 'Testimonials', 'url' => '/testimonials'],
            ['label' => 'Contact Us', 'url' => '/contact-us'],
        ];

        foreach ($headerItems as $index => $item) {
            MenuItem::query()->updateOrCreate(
                ['menu_id' => $headerMenu->id, 'label' => $item['label']],
                $item + ['menu_id' => $headerMenu->id, 'sort_order' => $index, 'status' => 'active']
            );
        }

        $footerItems = [
            ['label' => 'Privacy Policy', 'url' => null, 'page_id' => $privacyPage?->id],
            ['label' => 'Terms & Conditions', 'url' => null, 'page_id' => $termsPage?->id],
            ['label' => 'Contact Us', 'url' => '/contact-us'],
        ];

        foreach ($footerItems as $index => $item) {
            MenuItem::query()->updateOrCreate(
                ['menu_id' => $footerMenu->id, 'label' => $item['label']],
                $item + ['menu_id' => $footerMenu->id, 'sort_order' => $index, 'status' => 'active']
            );
        }
    }
}
