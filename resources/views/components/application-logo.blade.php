@props(['class' => 'auth-logo'])

<img src="{{ asset('assets/img/logo.png') }}" alt="{{ config('app.name', 'MNU Travels') }}" {{ $attributes->merge(['class' => $class]) }}>
