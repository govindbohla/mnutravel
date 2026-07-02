<nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo style="height: 36px; width: auto;" />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <x-dropdown align="end" width="220">
                        <x-slot name="trigger">
                            <span class="nav-link">
                                {{ Auth::user()->name }} <i class="fa-solid fa-chevron-down small"></i>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="{{ route('profile.edit') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </li>
            </ul>
        </div>
    </div>
</nav>
