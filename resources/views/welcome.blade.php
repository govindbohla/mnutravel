<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'MNU Travels') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="d-flex flex-column align-items-center justify-content-center text-center" style="min-height: 100vh;">
            <img src="{{ asset('assets/img/logo.png') }}" alt="MNU Travels" style="max-width: 140px;" class="mb-4">
            <h1 class="h3 text-brand-primary fw-semibold">MNU Travels</h1>
            <p class="text-muted">Public site under construction.</p>
            <a href="{{ route('login') }}" class="btn btn-primary mt-2">Admin Login</a>
        </div>
    </body>
</html>
