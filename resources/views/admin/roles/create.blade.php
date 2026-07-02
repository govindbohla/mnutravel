@extends('admin.layouts.app')

@section('content_header')
    <h1>Add Role</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @include('admin.roles._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Role</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
