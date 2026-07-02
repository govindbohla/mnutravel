@extends('admin.layouts.app')

@section('content_header')
    <h1>Add Booking</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.bookings.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @include('admin.bookings._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Booking</button>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
