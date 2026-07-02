@extends('admin.layouts.app')

@section('content_header')
    <h1>Add Vehicle</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @include('admin.vehicles._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Vehicle</button>
                <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
