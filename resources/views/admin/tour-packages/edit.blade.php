@extends('admin.layouts.app')

@section('content_header')
    <h1>Edit Tour Package</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.tour-packages.update', $package) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('admin.tour-packages._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Package</button>
                <a href="{{ route('admin.tour-packages.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
