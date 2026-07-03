@props(['src'])

@if ($src)
    <img src="{{ Str::startsWith($src, 'http') ? $src : asset('storage/'.$src) }}" class="img-thumb">
@else
    <span class="text-muted">—</span>
@endif
