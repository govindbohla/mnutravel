@extends('admin.layouts.app')

@section('content_header')
    <h1>Add Vehicle Category</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.vehicle-categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @include('admin.vehicle-categories._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Category</button>
                <a href="{{ route('admin.vehicle-categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
