@extends('front.layouts.app')

@section('title', 'Testimonials - '.$siteSettings['site_name'])
@section('meta_description', 'Read what our customers say about their experience with '.$siteSettings['site_name'].'.')

@section('content')
    <div class="bg-light py-5">
        <div class="container text-center">
            <h1 class="section-title">Testimonials</h1>
            <p class="section-subtitle mb-0">What our customers say about us</p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row g-4">
                @forelse ($testimonials as $testimonial)
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
                @empty
                    <div class="col-12 text-center text-muted py-5">No testimonials yet.</div>
                @endforelse
            </div>
        </div>
    </section>
@stop
