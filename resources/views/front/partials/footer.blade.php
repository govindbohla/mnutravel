<footer class="site-footer bg-dark text-light pt-5 pb-3">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <img src="{{ $siteSettings['site_logo_url'] }}" alt="{{ $siteSettings['site_name'] }}" style="height: 56px; width: auto;" class="mb-3 bg-white rounded p-1">
                <p class="text-light opacity-75">{{ $siteSettings['footer_about'] }}</p>
                <div class="d-flex gap-3 mt-3">
                    @if ($siteSettings['facebook_url'])
                        <a href="{{ $siteSettings['facebook_url'] }}" class="text-light" target="_blank" rel="noopener"><i class="fa-brands fa-facebook fa-lg"></i></a>
                    @endif
                    @if ($siteSettings['instagram_url'])
                        <a href="{{ $siteSettings['instagram_url'] }}" class="text-light" target="_blank" rel="noopener"><i class="fa-brands fa-instagram fa-lg"></i></a>
                    @endif
                    @if ($siteSettings['twitter_url'])
                        <a href="{{ $siteSettings['twitter_url'] }}" class="text-light" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter fa-lg"></i></a>
                    @endif
                    @if ($siteSettings['youtube_url'])
                        <a href="{{ $siteSettings['youtube_url'] }}" class="text-light" target="_blank" rel="noopener"><i class="fa-brands fa-youtube fa-lg"></i></a>
                    @endif
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="text-uppercase fw-semibold mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-light text-decoration-none opacity-75">Home</a></li>
                    <li class="mb-2"><a href="{{ route('vehicles.index') }}" class="text-light text-decoration-none opacity-75">Our Cars</a></li>
                    <li class="mb-2"><a href="{{ route('services.index') }}" class="text-light text-decoration-none opacity-75">Services</a></li>
                    <li class="mb-2"><a href="{{ route('tour-packages.index') }}" class="text-light text-decoration-none opacity-75">Tour Packages</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="text-uppercase fw-semibold mb-3">Legal</h6>
                <ul class="list-unstyled">
                    @foreach ($footerMenuItems as $item)
                        <li class="mb-2"><a href="{{ $item->resolvedUrl() }}" target="{{ $item->target }}" class="text-light text-decoration-none opacity-75">{{ $item->label }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="text-uppercase fw-semibold mb-3">Contact Us</h6>
                <ul class="list-unstyled opacity-75">
                    @if ($siteContactDetail?->address)
                        <li class="mb-2"><i class="fa-solid fa-location-dot me-2"></i>{{ $siteContactDetail->address }}</li>
                    @endif
                    @if ($siteContactDetail?->phone)
                        <li class="mb-2"><i class="fa-solid fa-phone me-2"></i><a href="tel:{{ $siteContactDetail->phone }}" class="text-light text-decoration-none">{{ $siteContactDetail->phone }}</a></li>
                    @endif
                    @if ($siteContactDetail?->email)
                        <li class="mb-2"><i class="fa-solid fa-envelope me-2"></i><a href="mailto:{{ $siteContactDetail->email }}" class="text-light text-decoration-none">{{ $siteContactDetail->email }}</a></li>
                    @endif
                </ul>
            </div>
        </div>

        <hr class="border-secondary my-4">

        <div class="text-center small opacity-75">
            {!! $siteSettings['footer_copyright'] !!}
        </div>
    </div>
</footer>
