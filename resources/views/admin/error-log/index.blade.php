@extends('admin.layouts.app')

@section('content_header')
    <h1>Error Log</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            <span class="text-muted small">Showing the most recent {{ count($entries) }} entries from storage/logs/laravel.log</span>
        </div>
        <div class="card-body p-0" style="max-height: 70vh; overflow-y: auto;">
            @forelse ($entries as $entry)
                @php
                    $level = strtolower($entry['level']);
                    $badge = match (true) {
                        str_contains($level, 'error') || str_contains($level, 'critical') || str_contains($level, 'emergency') => 'danger',
                        str_contains($level, 'warning') => 'warning',
                        default => 'secondary',
                    };
                @endphp
                <div class="p-3 border-bottom">
                    <span class="badge badge-{{ $badge }} text-uppercase">{{ $entry['level'] }}</span>
                    <span class="text-muted small ms-2">{{ $entry['date'] }}</span>
                    <pre class="mb-0 mt-2 small text-wrap" style="white-space: pre-wrap;">{{ Str::limit(trim($entry['message']), 1000) }}</pre>
                </div>
            @empty
                <div class="text-center text-muted py-4">No log entries found.</div>
            @endforelse
        </div>
    </div>
@stop
