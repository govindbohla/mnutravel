@extends('admin.layouts.app')

@section('content_header')
    <h1>Add FAQ</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @include('admin.faqs._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save FAQ</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
