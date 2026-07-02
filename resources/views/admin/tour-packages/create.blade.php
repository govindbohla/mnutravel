@extends('admin.layouts.app')

@section('content_header')
    <h1>Add Tour Package</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.tour-packages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @include('admin.tour-packages._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Package</button>
                <a href="{{ route('admin.tour-packages.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
