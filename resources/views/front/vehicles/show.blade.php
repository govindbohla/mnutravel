@extends('front.layouts.app')

@section('title', $vehicle->seoMeta?->meta_title ?? $vehicle->name.' - '.$siteSettings['site_name'])
@section('meta_description', $vehicle->seoMeta?->meta_description ?? Str::limit(strip_tags($vehicle->description), 160))

@section('content')
    <section class="section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-7">
                    <img src="{{ $vehicle->image ? asset('storage/'.$vehicle->image) : 'https://placehold.co/700x450?text='.urlencode($vehicle->name) }}" class="img-fluid rounded shadow-sm mb-3" alt="{{ $vehicle->name }}">

                    @if ($vehicle->images->isNotEmpty())
                        <div class="row g-2">
                            @foreach ($vehicle->images as $image)
                                <div class="col-3">
                                    <img src="{{ asset('storage/'.$image->image_path) }}" class="img-fluid rounded" alt="{{ $vehicle->name }}">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="col-lg-5">
                    <span class="badge bg-secondary mb-2">{{ $vehicle->category->name ?? '' }}</span>
                    <h1 class="h2 fw-bold">{{ $vehicle->name }}</h1>

                    <div class="d-flex gap-4 text-muted my-3">
                        <span><i class="fa-solid fa-user"></i> {{ $vehicle->passenger_capacity }} Seats</span>
                        <span><i class="fa-solid fa-suitcase"></i> {{ $vehicle->luggage_capacity }} Bags</span>
                        @if ($vehicle->is_ac)
                            <span><i class="fa-solid fa-snowflake"></i> AC</span>
                        @endif
                    </div>

                    @if ($vehicle->price)
                        <p class="h4 text-brand-primary fw-bold">₹{{ number_format($vehicle->price, 0) }} <span class="fs-6 text-muted fw-normal">/ day</span></p>
                    @endif

                    <p class="text-muted">{{ $vehicle->description }}</p>

                    <button type="button" class="btn btn-primary btn-lg mt-2" data-modal-target="booking-modal">
                        <i class="fa-solid fa-calendar-check"></i> Book This Vehicle
                    </button>
                </div>
            </div>

            @if ($relatedVehicles->isNotEmpty())
                <div class="mt-5 pt-4 border-top">
                    <h3 class="section-title">You May Also Like</h3>
                    <div class="row g-4">
                        @foreach ($relatedVehicles as $related)
                            <div class="col-lg-4 col-md-6">
                                <div class="card card-hover vehicle-card h-100">
                                    <img src="{{ $related->image ? asset('storage/'.$related->image) : 'https://placehold.co/400x300?text='.urlencode($related->name) }}" class="card-img-top" alt="{{ $related->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $related->name }}</h5>
                                        <a href="{{ route('vehicles.show', $related) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@stop
