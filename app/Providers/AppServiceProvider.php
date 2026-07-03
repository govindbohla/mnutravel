<?php

namespace App\Providers;

use App\View\Composers\FrontLayoutComposer;
use Illuminate\Pagination\Paginator;
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

        // Laravel's default pagination view is Tailwind-styled, but this
        // project has no Tailwind anywhere (admin runs AdminLTE/Bootstrap 4,
        // the public site runs Bootstrap 5). Without this, pagination links
        // render with Tailwind utility classes that have no effect, so
        // buttons and the active-page state appear completely unstyled.
        // Bootstrap 4's pagination markup (.pagination/.page-item/.page-link)
        // is compatible with both Bootstrap 4 and 5.
        Paginator::useBootstrapFour();
    }
}
