@props(['src'])

@if ($src)
    <img src="{{ asset('storage/'.$src) }}" class="img-thumb">
@else
    <span class="text-muted">—</span>
@endif
