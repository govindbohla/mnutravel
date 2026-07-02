@extends('adminlte::page')

@section('title', (isset($title) ? $title.' - ' : '').'MNU Travels Admin')

@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet">
    <style>
        body.hold-transition, .wrapper { font-family: 'Poppins', sans-serif; }
        .brand-link .brand-image { max-height: 33px; width: auto; }
        .nav-sidebar .nav-link.active { background-color: var(--mnu-primary); }
        .btn-primary { background-color: var(--mnu-primary); border-color: var(--mnu-primary); }
        .btn-primary:hover { background-color: var(--mnu-secondary); border-color: var(--mnu-secondary); }
    </style>
    @stack('css')
@stop

@section('js')
    @stack('scripts')
@stop
