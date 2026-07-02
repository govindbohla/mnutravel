@extends('admin.layouts.app')

@section('content_header')
    <h1>Activity Log</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Event</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>When</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activities as $activity)
                        <tr>
                            <td>{{ $activity->causer?->name ?? 'System' }}</td>
                            <td><span class="badge badge-info text-uppercase">{{ $activity->event }}</span></td>
                            <td>{{ class_basename($activity->subject_type) }} #{{ $activity->subject_id }}</td>
                            <td>{{ $activity->description }}</td>
                            <td title="{{ $activity->created_at }}">{{ $activity->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No activity recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($activities->hasPages())
            <div class="card-footer">
                {{ $activities->links() }}
            </div>
        @endif
    </div>
@stop
