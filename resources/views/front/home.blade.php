@extends('front.layouts.app')

@section('title', $siteSettings['meta_title'])
@section('meta_description', $siteSettings['meta_description'])

@section('content')

    {{-- Hero Slider --}}
    @if ($heroSliders->isNotEmpty())
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($heroSliders as $slide)
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <div class="hero-slide" style="background-image: url('{{ Str::startsWith($slide->image, 'http') ? $slide->image : asset('storage/'.$slide->image) }}');">
                            <div class="container hero-content">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <h1 class="display-5">{{ $slide->title }}</h1>
                                        @if ($slide->subtitle)
                                            <p class="lead">{{ $slide->subtitle }}</p>
                                        @endif
                                        @if ($slide->button_text)
                                            <a href="{{ $slide->button_link ?? '#' }}"
                                               @if ($slide->button_link === '#booking-modal') data-modal-target="booking-modal" @endif
                                               class="btn btn-lg btn-light text-brand-primary fw-semibold mt-3">
                                                {{ $slide->button_text }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($heroSliders->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            @endif
        </div>
    @endif

    {{-- About Section --}}
    <section class="section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <img src="{{ $siteSettings['site_logo_url'] }}" alt="{{ $siteSettings['site_name'] }}" class="img-fluid rounded shadow-sm" style="max-width: 320px;">
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title">About {{ $siteSettings['site_name'] }}</h2>
                    <p class="text-muted">{{ $siteSettings['footer_about'] }}</p>
                    <a href="{{ route('page.show', 'about-us') }}" class="btn btn-primary mt-2">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section class="section bg-light">
        <div class="container">
            <h2 class="section-title text-center">Why Choose Us</h2>
            <p class="section-subtitle text-center">Reasons travellers across India trust {{ $siteSettings['site_name'] }}</p>
            <div class="row g-4 text-center">
                <div class="col-md-3 col-6">
                    <div class="service-icon"><i class="fa-solid fa-shield-halved"></i></div>
                    <h6 class="fw-semibold">Safe &amp; Reliable</h6>
                    <p class="text-muted small">Verified drivers and well-maintained vehicles for every trip.</p>
                </div>
                <div class="col-md-3 col-6">
                    <div class="service-icon"><i class="fa-solid fa-headset"></i></div>
                    <h6 class="fw-semibold">24/7 Support</h6>
                    <p class="text-muted small">Round-the-clock booking and customer support.</p>
                </div>
                <div class="col-md-3 col-6">
                    <div class="service-icon"><i class="fa-solid fa-user-tie"></i></div>
                    <h6 class="fw-semibold">Professional Drivers</h6>
                    <p class="text-muted small">Experienced, courteous, and trained chauffeurs.</p>
                </div>
                <div class="col-md-3 col-6">
                    <div class="service-icon"><i class="fa-solid fa-tags"></i></div>
                    <h6 class="fw-semibold">Affordable Pricing</h6>
                    <p class="text-muted small">Transparent fares with no hidden charges.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Vehicles --}}
    @if ($vehicles->isNotEmpty())
        <section class="section">
            <div class="container">
                <h2 class="section-title text-center">Our Vehicles</h2>
                <p class="section-subtitle text-center">Choose from our diverse, well-maintained fleet</p>
                <div class="row g-4">
                    @foreach ($vehicles as $vehicle)
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
                                    <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('vehicles.index') }}" class="btn btn-primary">View All Vehicles</a>
                </div>
            </div>
        </section>
    @endif

    {{-- Services --}}
    @if ($services->isNotEmpty())
        <section class="section bg-light">
            <div class="container">
                <h2 class="section-title text-center">Our Services</h2>
                <p class="section-subtitle text-center">Complete travel solutions under one roof</p>
                <div class="row g-4">
                    @foreach ($services as $service)
                        <div class="col-lg-4 col-md-6">
                            <div class="card card-hover h-100 text-center p-4">
                                <div class="service-icon">
                                    <i class="{{ $service->icon ?? 'fa-solid fa-car' }}"></i>
                                </div>
                                <h5 class="card-title">{{ $service->name }}</h5>
                                <p class="text-muted small">{{ $service->short_description }}</p>
                                <a href="{{ route('services.show', $service) }}" class="stretched-link"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Popular Tour Packages --}}
    @if ($packages->isNotEmpty())
        <section class="section">
            <div class="container">
                <h2 class="section-title text-center">Popular Tour Packages</h2>
                <p class="section-subtitle text-center">Curated journeys for unforgettable memories</p>
                <div class="row g-4">
                    @foreach ($packages as $package)
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
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('tour-packages.index') }}" class="btn btn-primary">View All Packages</a>
                </div>
            </div>
        </section>
    @endif

    {{-- Testimonials --}}
    @if ($testimonials->isNotEmpty())
        <section class="section bg-light">
            <div class="container">
                <h2 class="section-title text-center">What Our Customers Say</h2>
                <p class="section-subtitle text-center">Real experiences from real travellers</p>
                <div class="row g-4">
                    @foreach ($testimonials as $testimonial)
                        <div class="col-lg-4 col-md-6">
                            <div class="testimonial-card shadow-sm">
                                <div class="mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </div>
                                <p class="text-muted">&ldquo;{{ $testimonial->review }}&rdquo;</p>
                                <div class="d-flex align-items-center mt-3">
                                    @if ($testimonial->image)
                                        <img src="{{ asset('storage/'.$testimonial->image) }}" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;" alt="{{ $testimonial->customer_name }}">
                                    @endif
                                    <strong>{{ $testimonial->customer_name }}</strong>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- FAQ --}}
    @if ($faqs->isNotEmpty())
        <section class="section">
            <div class="container">
                <h2 class="section-title text-center">Frequently Asked Questions</h2>
                <p class="section-subtitle text-center">Everything you need to know before booking</p>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="accordion" id="faqAccordion">
                            @foreach ($faqs as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button @if (! $loop->first) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="faq{{ $faq->id }}" class="accordion-collapse collapse @if ($loop->first) show @endif" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body text-muted">{{ $faq->answer }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Contact CTA --}}
    <section class="cta-section section text-center">
        <div class="container">
            <h2 class="fw-bold mb-3">Ready to Book Your Ride?</h2>
            <p class="mb-4">Get in touch with us today for a safe and comfortable journey.</p>
            <button type="button" class="btn btn-light text-brand-primary fw-semibold me-2" data-modal-target="booking-modal">Book Now</button>
            <button type="button" class="btn btn-outline-light fw-semibold" data-modal-target="enquiry-modal">Send Enquiry</button>
        </div>
    </section>

@stop
