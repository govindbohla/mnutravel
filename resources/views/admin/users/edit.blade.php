@extends('admin.layouts.app')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.users.update', $editUser) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('admin.users._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
