@extends('front.layouts.app')

@section('title', 'Our Cars - '.$siteSettings['site_name'])
@section('meta_description', 'Browse our fleet of sedans, SUVs, luxury cars, and tempo travellers available for booking.')

@section('content')
    <div class="bg-light py-5">
        <div class="container text-center">
            <h1 class="section-title">Our Cars</h1>
            <p class="section-subtitle mb-0">Choose the perfect vehicle for your journey</p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
                <a href="{{ route('vehicles.index') }}" class="btn btn-sm {{ request('category') ? 'btn-outline-primary' : 'btn-primary' }}">All</a>
                @foreach ($categories as $category)
                    <a href="{{ route('vehicles.index', ['category' => $category->slug]) }}" class="btn btn-sm {{ request('category') === $category->slug ? 'btn-primary' : 'btn-outline-primary' }}">{{ $category->name }}</a>
                @endforeach
            </div>

            <div class="row g-4">
                @forelse ($vehicles as $vehicle)
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-hover vehicle-card h-100">
                            <img src="{{ $vehicle->image ? asset('storage/'.$vehicle->image) : 'https://placehold.co/400x300?text='.urlencode($vehicle->name) }}" class="card-img-top" alt="{{ $vehicle->name }}">
                            <div class="card-body">
                                <span class="badge bg-secondary mb-2">{{ $vehicle->category->name ?? '' }}</span>
                                <h5 class="card-title">{{ $vehicle->name }}</h5>
                                <p class="text-muted small mb-2">
                                    <i class="fa-solid fa-user"></i> {{ $vehicle->passenger_capacity }} Seats
                                    &nbsp;|&nbsp;
                                    <i class="fa-solid fa-suitcase"></i> {{ $vehicle->luggage_capacity }} Bags
                                    @if ($vehicle->is_ac) &nbsp;|&nbsp;<i class="fa-solid fa-snowflake"></i> AC @endif
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($vehicle->price)
                                        <span class="fw-semibold text-brand-primary">₹{{ number_format($vehicle->price, 0) }}/day</span>
                                    @endif
                                    <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">No vehicles found.</div>
                @endforelse
            </div>

            @if ($vehicles->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $vehicles->links() }}
                </div>
            @endif
        </div>
    </section>
@stop
