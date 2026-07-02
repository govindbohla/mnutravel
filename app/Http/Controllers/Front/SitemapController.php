<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Service;
use App\Models\TourPackage;
use App\Models\Vehicle;
use Illuminate\Http\Response;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $sitemap = Sitemap::create()
            ->add(Url::create(route('home'))->setPriority(1.0))
            ->add(Url::create(route('vehicles.index'))->setPriority(0.9))
            ->add(Url::create(route('services.index'))->setPriority(0.9))
            ->add(Url::create(route('tour-packages.index'))->setPriority(0.9))
            ->add(Url::create(route('testimonials.index'))->setPriority(0.6))
            ->add(Url::create(route('contact.index'))->setPriority(0.7));

        Vehicle::active()->each(function (Vehicle $vehicle) use ($sitemap) {
            $sitemap->add(
                Url::create(route('vehicles.show', $vehicle))
                    ->setLastModificationDate($vehicle->updated_at)
                    ->setPriority(0.8)
            );
        });

        Service::active()->each(function (Service $service) use ($sitemap) {
            $sitemap->add(
                Url::create(route('services.show', $service))
                    ->setLastModificationDate($service->updated_at)
                    ->setPriority(0.8)
            );
        });

        TourPackage::active()->each(function (TourPackage $package) use ($sitemap) {
            $sitemap->add(
                Url::create(route('tour-packages.show', $package))
                    ->setLastModificationDate($package->updated_at)
                    ->setPriority(0.8)
            );
        });

        Page::active()->each(function (Page $page) use ($sitemap) {
            $sitemap->add(
                Url::create(route('page.show', $page->slug))
                    ->setLastModificationDate($page->updated_at)
                    ->setPriority(0.5)
            );
        });

        return response($sitemap->render(), 200)->header('Content-Type', 'text/xml');
    }
}
