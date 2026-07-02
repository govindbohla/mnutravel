<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0 fw-semibold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                {{ __("You're logged in!") }}
            </div>
        </div>
    </div>
</x-app-layout>
