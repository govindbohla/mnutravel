@extends('admin.layouts.app')

@section('content_header')
    <h1>Edit Enquiry</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.enquiries.update', $enquiry) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('admin.enquiries._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Enquiry</button>
                <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
