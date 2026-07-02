@extends('admin.layouts.app')

@section('content_header')
    <h1>Edit Customer</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.customers.update', $customer) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('admin.customers._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Customer</button>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
