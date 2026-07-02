@extends('admin.layouts.app')

@section('content_header')
    <h1>Edit Booking - {{ $booking->booking_no }}</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('admin.bookings._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Booking</button>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
