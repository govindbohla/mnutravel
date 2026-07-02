<?php

namespace App\Providers;

use App\View\Composers\FrontLayoutComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Matches every front.* view (not just the layout) since child views
        // reference $siteSettings etc. in their own top-level @section(...)
        // calls, which execute before the parent layout is rendered.
        View::composer('front.*', FrontLayoutComposer::class);
    }
}
