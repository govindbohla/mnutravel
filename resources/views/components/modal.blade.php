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

{{--
    Vanilla-JS modal (no dependency on Bootstrap's JS plugin) so the same
    component works both on the public Bootstrap 5 site and inside the
    admin panel, which runs AdminLTE 3's bundled Bootstrap 4 JS.
    Open with: data-modal-target="{{ $name }}"
    Close with: data-modal-dismiss inside the modal markup.
--}}
<div class="modal fade {{ $show ? 'show' : '' }}" id="{{ $name }}" tabindex="-1" aria-hidden="true" style="{{ $show ? 'display:block;' : '' }}">
    <div class="modal-dialog modal-dialog-centered {{ $maxWidthClass }}">
        <div class="modal-content">
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

@if ($show)
    <div class="modal-backdrop fade show" data-modal-backdrop="{{ $name }}"></div>
@endif

@once
    @push('scripts')
        <script>
            (function () {
                function showModal(modal) {
                    modal.classList.add('show');
                    modal.style.display = 'block';
                    document.body.classList.add('modal-open');
                    var backdrop = document.createElement('div');
                    backdrop.className = 'modal-backdrop fade show';
                    backdrop.setAttribute('data-modal-backdrop', modal.id);
                    document.body.appendChild(backdrop);
                }

                function hideModal(modal) {
                    modal.classList.remove('show');
                    modal.style.display = 'none';
                    document.body.classList.remove('modal-open');
                    document.querySelectorAll('[data-modal-backdrop="' + modal.id + '"]').forEach(function (el) {
                        el.remove();
                    });
                }

                document.addEventListener('click', function (e) {
                    var opener = e.target.closest('[data-modal-target]');
                    if (opener) {
                        var modal = document.getElementById(opener.getAttribute('data-modal-target'));
                        if (modal) {
                            showModal(modal);
                        }
                    }

                    var closer = e.target.closest('[data-modal-dismiss]');
                    if (closer) {
                        var modal = closer.closest('.modal');
                        if (modal) {
                            hideModal(modal);
                        }
                    }

                    if (e.target.hasAttribute('data-modal-backdrop')) {
                        var modal = document.getElementById(e.target.getAttribute('data-modal-backdrop'));
                        if (modal) {
                            hideModal(modal);
                        }
                    }
                });
            })();
        </script>
    @endpush
@endonce
