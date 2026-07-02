@extends('admin.layouts.app')

@section('content_header')
    <h1>Edit Page</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.pages.update', $page) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('admin.pages._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Page</button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
