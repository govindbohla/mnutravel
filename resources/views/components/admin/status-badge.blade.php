@props(['status'])

@php
$colors = [
    'active' => 'success',
    'inactive' => 'secondary',
    'new' => 'info',
    'pending' => 'warning',
    'confirmed' => 'primary',
    'completed' => 'success',
    'cancelled' => 'danger',
    'contacted' => 'primary',
    'interested' => 'info',
    'follow_up' => 'warning',
    'converted' => 'success',
    'closed' => 'secondary',
];
$color = $colors[$status] ?? 'secondary';
$label = ucwords(str_replace('_', ' ', $status));
@endphp

<span class="badge badge-{{ $color }}">{{ $label }}</span>
