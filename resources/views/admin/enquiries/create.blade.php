@extends('admin.layouts.app')

@section('content_header')
    <h1>Add Enquiry</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.enquiries.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @include('admin.enquiries._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Enquiry</button>
                <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
