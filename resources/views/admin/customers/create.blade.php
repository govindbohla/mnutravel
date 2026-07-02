@extends('admin.layouts.app')

@section('content_header')
    <h1>Add Customer</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.customers.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @include('admin.customers._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Customer</button>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
