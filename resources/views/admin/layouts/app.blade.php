@extends('adminlte::page')

@section('title', (isset($title) ? $title.' - ' : '').'MNU Travels Admin')

@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css" rel="stylesheet">
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
    <script>
        /**
         * Re-run on initial load and after every AJAX content swap
         * (see admin-nav.js) so widgets inside the newly injected
         * .content-wrapper markup are (re)initialized correctly.
         */
        function initAdminWidgets() {
            var $tables = $('.admin-datatable');
            $tables.each(function () {
                var $table = $(this);
                if ($.fn.DataTable.isDataTable($table)) {
                    $table.DataTable().destroy();
                }
            });
            $tables.DataTable({
                order: [],
                pageLength: 25,
            });

            var $editors = $('.summernote-editor');
            $editors.each(function () {
                var $editor = $(this);
                if ($editor.next('.note-editor').length) {
                    $editor.summernote('destroy');
                }
                $editor.summernote({ height: 300 });
            });
        }

        $(function () {
            initAdminWidgets();
        });
    </script>
    <script src="{{ asset('assets/js/admin-nav.js') }}"></script>
    @stack('scripts')
@stop
