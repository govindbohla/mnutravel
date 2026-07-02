@extends('admin.layouts.app')

@section('content_header')
    <h1>Edit FAQ</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                @include('admin.faqs._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update FAQ</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
