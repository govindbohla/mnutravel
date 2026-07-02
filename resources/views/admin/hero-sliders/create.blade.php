@extends('admin.layouts.app')

@section('content_header')
    <h1>Add Hero Slide</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.hero-sliders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @include('admin.hero-sliders._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Slide</button>
                <a href="{{ route('admin.hero-sliders.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
