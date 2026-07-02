<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $siteSettings['meta_title'])</title>
    <meta name="description" content="@yield('meta_description', $siteSettings['meta_description'])">
    <meta name="keywords" content="@yield('meta_keywords', $siteSettings['meta_keywords'])">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    <meta property="og:site_name" content="{{ $siteSettings['site_name'] }}">
    <meta property="og:title" content="@yield('title', $siteSettings['meta_title'])">
    <meta property="og:description" content="@yield('meta_description', $siteSettings['meta_description'])">
    <meta property="og:type" content="website">
    <meta property="og:url" content="@yield('canonical_url', url()->current())">
    <meta property="og:image" content="@yield('og_image', $siteSettings['site_logo_url'])">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $siteSettings['meta_title'])">
    <meta name="twitter:description" content="@yield('meta_description', $siteSettings['meta_description'])">
    <meta name="twitter:image" content="@yield('og_image', $siteSettings['site_logo_url'])">

    <link rel="icon" href="{{ $siteSettings['site_favicon_url'] }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/front.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>
    @include('front.partials.header')

    <main>
        @yield('content')
    </main>

    @include('front.partials.footer')
    @include('front.partials.whatsapp-float')
    @include('front.partials.booking-modal')
    @include('front.partials.enquiry-modal')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/front.js') }}"></script>
    @stack('scripts')
</body>
</html>
