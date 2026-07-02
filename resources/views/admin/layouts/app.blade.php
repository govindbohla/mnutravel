@extends('adminlte::page')

@section('title', (isset($title) ? $title.' - ' : '').'MNU Travels Admin')

@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet">
    <style>
        body.hold-transition, .wrapper { font-family: 'Poppins', sans-serif; }
        .brand-link .brand-image { max-height: 33px; width: auto; }
        .nav-sidebar .nav-link.active { background-color: var(--mnu-primary); }
        .btn-primary { background-color: var(--mnu-primary); border-color: var(--mnu-primary); }
        .btn-primary:hover { background-color: var(--mnu-secondary); border-color: var(--mnu-secondary); }
        .img-thumb { width: 48px; height: 48px; object-fit: cover; border-radius: 4px; }
    </style>
    @stack('css')
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function () {
            $('.admin-datatable').DataTable({
                order: [],
                pageLength: 25,
            });
        });
    </script>
    @stack('scripts')
@stop
