@extends('front.layouts.app')

@section('title', $package->seoMeta?->meta_title ?? $package->name.' - '.$siteSettings['site_name'])
@section('meta_description', $package->seoMeta?->meta_description ?? Str::limit(strip_tags($package->description), 160))
@section('meta_keywords', $package->seoMeta?->meta_keywords ?? $siteSettings['meta_keywords'])
@section('canonical_url', $package->seoMeta?->canonical_url ?? url()->current())
@section('og_image', $package->featured_image ? asset('storage/'.$package->featured_image) : $siteSettings['site_logo_url'])

@section('content')
    <section class="section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-7">
                    <img src="{{ $package->featured_image ? asset('storage/'.$package->featured_image) : 'https://placehold.co/700x450?text='.urlencode($package->name) }}" class="img-fluid rounded shadow-sm mb-3" alt="{{ $package->name }}">

                    @if ($package->images->isNotEmpty())
                        <div class="row g-2 mb-4">
                            @foreach ($package->images as $image)
                                <div class="col-3">
                                    <img src="{{ asset('storage/'.$image->image_path) }}" class="img-fluid rounded" alt="{{ $package->name }}">
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <h2 class="h4 fw-semibold">Overview</h2>
                    <p class="text-muted">{{ $package->description }}</p>

                    <div class="row mt-4">
                        @if ($package->inclusions)
                            <div class="col-md-6">
                                <h5 class="fw-semibold text-success"><i class="fa-solid fa-circle-check"></i> Inclusions</h5>
                                <ul class="text-muted">
                                    @foreach (preg_split('/\r\n|\r|\n/', $package->inclusions) as $line)
                                        @if (trim($line) !== '')
                                            <li>{{ trim($line) }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($package->exclusions)
                            <div class="col-md-6">
                                <h5 class="fw-semibold text-danger"><i class="fa-solid fa-circle-xmark"></i> Exclusions</h5>
                                <ul class="text-muted">
                                    @foreach (preg_split('/\r\n|\r|\n/', $package->exclusions) as $line)
                                        @if (trim($line) !== '')
                                            <li>{{ trim($line) }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card p-4 shadow-sm">
                        <h1 class="h3 fw-bold">{{ $package->name }}</h1>
                        <p class="text-muted mb-1"><i class="fa-solid fa-location-dot"></i> {{ $package->destination }}</p>
                        <p class="text-muted mb-3"><i class="fa-solid fa-clock"></i> {{ $package->duration }}</p>

                        @if ($package->price)
                            <p class="h4 text-brand-primary fw-bold">₹{{ number_format($package->price, 0) }} <span class="fs-6 text-muted fw-normal">/ person</span></p>
                        @endif

                        <button type="button" class="btn btn-primary btn-lg mt-2" data-modal-target="enquiry-modal">
                            <i class="fa-solid fa-envelope"></i> Enquire Now
                        </button>
                    </div>

                    @if ($otherPackages->isNotEmpty())
                        <div class="mt-4">
                            <h6 class="fw-semibold mb-3">Other Packages</h6>
                            @foreach ($otherPackages as $other)
                                <a href="{{ route('tour-packages.show', $other) }}" class="d-flex align-items-center text-decoration-none mb-3">
                                    <img src="{{ $other->featured_image ? asset('storage/'.$other->featured_image) : 'https://placehold.co/80x60' }}" style="width: 70px; height: 50px; object-fit: cover;" class="rounded me-2">
                                    <div>
                                        <div class="fw-semibold small">{{ $other->name }}</div>
                                        <div class="text-muted small">{{ $other->duration }}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop
