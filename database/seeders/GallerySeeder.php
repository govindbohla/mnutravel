<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    protected const TOTAL = 30;

    protected const CATEGORIES = ['Vehicles', 'Tours', 'Events', 'Office'];

    public function run(): void
    {
        $existing = Gallery::count();

        if ($existing >= self::TOTAL) {
            return;
        }

        for ($i = $existing + 1; $i <= self::TOTAL; $i++) {
            $category = self::CATEGORIES[($i - 1) % count(self::CATEGORIES)];

            Gallery::create([
                'title' => $category.' Photo '.$i,
                'image' => 'https://placehold.co/800x600?text='.urlencode($category.' '.$i),
                'category' => $category,
                'status' => 'active',
            ]);
        }
    }
}
