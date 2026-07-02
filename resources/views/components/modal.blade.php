@props([
    'name',
    'show' => false,
    'maxWidth' => 'md',
])

@php
$maxWidthClass = [
    'sm' => 'modal-sm',
    'md' => '',
    'lg' => 'modal-lg',
    'xl' => 'modal-xl',
    '2xl' => 'modal-xl',
][$maxWidth] ?? '';
@endphp

<div class="modal fade" id="{{ $name }}" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered {{ $maxWidthClass }}">
        <div class="modal-content">
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

@if ($show)
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new bootstrap.Modal(document.getElementById('{{ $name }}')).show();
            });
        </script>
    @endpush
@endif
