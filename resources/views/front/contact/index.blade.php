@extends('front.layouts.app')

@section('title', 'Contact Us - '.$siteSettings['site_name'])
@section('meta_description', 'Get in touch with '.$siteSettings['site_name'].' for bookings, enquiries, and support.')

@section('content')
    <div class="bg-light py-5">
        <div class="container text-center">
            <h1 class="section-title">Contact Us</h1>
            <p class="section-subtitle mb-0">We're here to help, 24/7</p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row g-4 mb-5 text-center">
                @if ($contactDetail?->address)
                    <div class="col-md-4">
                        <div class="service-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <h6 class="fw-semibold">Address</h6>
                        <p class="text-muted small">{{ $contactDetail->address }}</p>
                    </div>
                @endif
                @if ($contactDetail?->phone)
                    <div class="col-md-4">
                        <div class="service-icon"><i class="fa-solid fa-phone"></i></div>
                        <h6 class="fw-semibold">Phone</h6>
                        <p class="text-muted small">
                            <a href="tel:{{ $contactDetail->phone }}" class="text-decoration-none text-muted">{{ $contactDetail->phone }}</a>
                            @if ($contactDetail->alt_phone)
                                <br><a href="tel:{{ $contactDetail->alt_phone }}" class="text-decoration-none text-muted">{{ $contactDetail->alt_phone }}</a>
                            @endif
                        </p>
                    </div>
                @endif
                @if ($contactDetail?->email)
                    <div class="col-md-4">
                        <div class="service-icon"><i class="fa-solid fa-envelope"></i></div>
                        <h6 class="fw-semibold">Email</h6>
                        <p class="text-muted small"><a href="mailto:{{ $contactDetail->email }}" class="text-decoration-none text-muted">{{ $contactDetail->email }}</a></p>
                    </div>
                @endif
            </div>

            @if ($contactDetail?->business_hours)
                <div class="text-center mb-5">
                    <h6 class="fw-semibold">Business Hours</h6>
                    <p class="text-muted small mb-0">
                        Mon - Sat: {{ $contactDetail->business_hours['monday_saturday'] ?? '' }}
                        &nbsp;|&nbsp;
                        Sunday: {{ $contactDetail->business_hours['sunday'] ?? '' }}
                    </p>
                    @if (!empty($contactDetail->business_hours['note']))
                        <p class="text-muted small">{{ $contactDetail->business_hours['note'] }}</p>
                    @endif
                </div>
            @endif

            <div class="row g-5">
                <div class="col-lg-6">
                    <h3 class="section-title">Send Us a Message</h3>
                    <form id="contact-enquiry-form" novalidate>
                        @csrf
                        <div id="contact-enquiry-alert"></div>
                        <div class="mb-3">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" rows="4" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>

                <div class="col-lg-6">
                    @if ($contactDetail?->map_iframe)
                        <div class="ratio ratio-4x3">
                            {!! $contactDetail->map_iframe !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop

@push('scripts')
    <script>
        $(function () {
            $('#contact-enquiry-form').on('submit', function (e) {
                e.preventDefault();
                var $form = $(this);
                var $alert = $('#contact-enquiry-alert');
                var $button = $form.find('button[type="submit"]');
                $button.prop('disabled', true).text('Sending...');

                $.ajax({
                    url: '/enquiry',
                    method: 'POST',
                    data: $form.serialize(),
                }).done(function (response) {
                    $alert.html('<div class="alert alert-success">' + response.message + '</div>');
                    $form.trigger('reset');
                }).fail(function (xhr) {
                    var html = '<div class="alert alert-danger"><ul class="mb-0">';
                    if (xhr.status === 422) {
                        Object.values(xhr.responseJSON.errors).forEach(function (messages) {
                            messages.forEach(function (message) { html += '<li>' + message + '</li>'; });
                        });
                    } else {
                        html += '<li>Something went wrong. Please try again.</li>';
                    }
                    html += '</ul></div>';
                    $alert.html(html);
                }).always(function () {
                    $button.prop('disabled', false).text('Send Message');
                });
            });
        });
    </script>
@endpush
