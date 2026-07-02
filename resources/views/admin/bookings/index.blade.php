@extends('admin.layouts.app')

@section('content_header')
    <h1>Bookings</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            <form method="GET" class="form-inline">
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control form-control-sm mr-2" placeholder="Search booking no, name, phone, location...">

                <select name="status" class="form-control form-control-sm mr-2">
                    <option value="">All Statuses</option>
                    @foreach (['new', 'pending', 'confirmed', 'completed', 'cancelled'] as $status)
                        <option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>

                <select name="trip_type" class="form-control form-control-sm mr-2">
                    <option value="">All Trip Types</option>
                    <option value="one_way" @selected(($filters['trip_type'] ?? '') === 'one_way')>One Way</option>
                    <option value="round_trip" @selected(($filters['trip_type'] ?? '') === 'round_trip')>Round Trip</option>
                </select>

                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-outline-secondary ml-1">Reset</a>
            </form>

            @can('bookings.create')
                <a href="{{ route('admin.bookings.create') }}" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus"></i> Add Booking
                </a>
            @endcan
        </div>

        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Booking No</th>
                        <th>Customer</th>
                        <th>Trip</th>
                        <th>Route</th>
                        <th>Journey</th>
                        <th>Vehicle</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->booking_no }}</td>
                            <td>
                                {{ $booking->customer_name }}<br>
                                <small class="text-muted">{{ $booking->phone }}</small>
                            </td>
                            <td>{{ $booking->trip_type === 'one_way' ? 'One Way' : 'Round Trip' }}</td>
                            <td>{{ $booking->pickup_location }} &rarr; {{ $booking->drop_location }}</td>
                            <td>{{ $booking->journey_date->format('d M Y') }} {{ \Illuminate\Support\Carbon::parse($booking->journey_time)->format('h:i A') }}</td>
                            <td>{{ $booking->vehicle?->name ?? '—' }}</td>
                            <td><x-admin.status-badge :status="$booking->status" /></td>
                            <td class="text-right">
                                @can('bookings.edit')
                                    <a href="{{ route('admin.bookings.edit', $booking) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('bookings.delete')
                                    <x-admin.delete-button :route="route('admin.bookings.destroy', $booking)" />
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($bookings->hasPages())
            <div class="card-footer">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
@stop
