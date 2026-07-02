@extends('front.layouts.app')

@section('title', 'Our Services - '.$siteSettings['site_name'])
@section('meta_description', 'Explore our complete range of taxi services including airport transfer, outstation taxi, local taxi, corporate taxi, wedding taxi, and railway pickup.')

@section('content')
    <div class="bg-light py-5">
        <div class="container text-center">
            <h1 class="section-title">Our Services</h1>
            <p class="section-subtitle mb-0">Complete travel solutions under one roof</p>
        </div>
    </div>

    <section class="section">
        <div class="container">
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
@stop
