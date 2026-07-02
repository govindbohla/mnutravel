@extends('front.layouts.app')

@section('title', 'Tour Packages - '.$siteSettings['site_name'])
@section('meta_description', 'Discover curated tour packages across popular destinations with hotel, sightseeing, and transport included.')

@section('content')
    <div class="bg-light py-5">
        <div class="container text-center">
            <h1 class="section-title">Tour Packages</h1>
            <p class="section-subtitle mb-0">Curated journeys for unforgettable memories</p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row g-4">
                @forelse ($packages as $package)
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-hover package-card h-100">
                            <img src="{{ $package->featured_image ? asset('storage/'.$package->featured_image) : 'https://placehold.co/400x300?text='.urlencode($package->name) }}" class="card-img-top" alt="{{ $package->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $package->name }}</h5>
                                <p class="text-muted small mb-1"><i class="fa-solid fa-location-dot"></i> {{ $package->destination }}</p>
                                <p class="text-muted small mb-2"><i class="fa-solid fa-clock"></i> {{ $package->duration }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($package->price)
                                        <span class="fw-semibold text-brand-primary">₹{{ number_format($package->price, 0) }}</span>
                                    @endif
                                    <a href="{{ route('tour-packages.show', $package) }}" class="btn btn-outline-primary btn-sm">View Package</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">No tour packages found.</div>
                @endforelse
            </div>

            @if ($packages->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $packages->links() }}
                </div>
            @endif
        </div>
    </section>
@stop
