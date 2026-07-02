@props(['align' => 'end', 'width' => '48', 'contentClasses' => 'py-1'])

<div class="dropdown">
    <div role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $trigger }}
    </div>

    <ul class="dropdown-menu dropdown-menu-{{ $align }} {{ $contentClasses }}" style="min-width: {{ $width }}px;">
        {{ $content }}
    </ul>
</div>
