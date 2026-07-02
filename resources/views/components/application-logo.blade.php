@props(['class' => 'auth-logo'])

<img src="{{ \App\Support\Settings::get('site_logo_url', asset('assets/img/logo.png')) }}" alt="{{ config('app.name', 'MNU Travels') }}" {{ $attributes->merge(['class' => $class]) }}>
