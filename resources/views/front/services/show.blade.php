@extends('front.layouts.app')

@section('title', $service->seoMeta?->meta_title ?? $service->name.' - '.$siteSettings['site_name'])
@section('meta_description', $service->seoMeta?->meta_description ?? $service->short_description)

@section('content')
    <section class="section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    @if ($service->image)
                        <img src="{{ asset('storage/'.$service->image) }}" class="img-fluid rounded shadow-sm mb-4" alt="{{ $service->name }}">
                    @endif

                    <div class="service-icon mb-3">
                        <i class="{{ $service->icon ?? 'fa-solid fa-car' }}"></i>
                    </div>
                    <h1 class="h2 fw-bold">{{ $service->name }}</h1>
                    <p class="lead text-muted">{{ $service->short_description }}</p>
                    <div class="mt-3">{!! nl2br(e($service->description)) !!}</div>

                    <button type="button" class="btn btn-primary btn-lg mt-4" data-modal-target="enquiry-modal">
                        <i class="fa-solid fa-envelope"></i> Enquire About This Service
                    </button>
                </div>

                <div class="col-lg-4">
                    <div class="card p-3">
                        <h6 class="fw-semibold mb-3">Other Services</h6>
                        <ul class="list-unstyled mb-0">
                            @foreach ($otherServices as $other)
                                <li class="mb-2">
                                    <a href="{{ route('services.show', $other) }}" class="text-decoration-none">
                                        <i class="{{ $other->icon ?? 'fa-solid fa-car' }} text-brand-primary me-2"></i>{{ $other->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
