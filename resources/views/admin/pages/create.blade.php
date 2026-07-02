@extends('admin.layouts.app')

@section('content_header')
    <h1>Add Page</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.pages.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @include('admin.pages._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Page</button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
