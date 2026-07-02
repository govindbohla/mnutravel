<header class="site-header sticky-top bg-white shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light py-2">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ $siteSettings['site_logo_url'] }}" alt="{{ $siteSettings['site_name'] }}" style="height: 48px; width: auto;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto">
                    @foreach ($headerMenuItems as $item)
                        @if ($item->children->isNotEmpty())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">{{ $item->label }}</a>
                                <ul class="dropdown-menu">
                                    @foreach ($item->children as $child)
                                        <li><a class="dropdown-item" href="{{ $child->resolvedUrl() }}" target="{{ $child->target }}">{{ $child->label }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $item->resolvedUrl() }}" target="{{ $item->target }}">{{ $item->label }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>

                <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                    @if ($siteSettings['primary_phone'])
                        <a href="tel:{{ $siteSettings['primary_phone'] }}" class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-phone"></i> {{ $siteSettings['primary_phone'] }}
                        </a>
                    @endif
                    <button type="button" class="btn btn-primary btn-sm" data-modal-target="booking-modal">
                        <i class="fa-solid fa-calendar-check"></i> Book Now
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>
