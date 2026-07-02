@extends('admin.layouts.app')

@section('content_header')
    <h1>Add Gallery Image</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @include('admin.gallery._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Image</button>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
