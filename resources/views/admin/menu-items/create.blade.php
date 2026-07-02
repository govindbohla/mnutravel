@extends('admin.layouts.app')

@section('content_header')
    <h1>Add {{ $pageTitle }} Item</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route($routePrefix.'.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @include('admin.menu-items._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Item</button>
                <a href="{{ route($routePrefix.'.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
