@extends('admin.layouts.app')

@section('content_header')
    <h1>Pages</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            @can('pages.create')
                <a href="{{ route('admin.pages.create') }}" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus"></i> Add Page
                </a>
            @endcan
        </div>

        <div class="card-body">
            <table class="table table-striped admin-datatable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $page)
                        <tr>
                            <td>{{ $page->title }}</td>
                            <td><code>/{{ $page->slug }}</code></td>
                            <td><x-admin.status-badge :status="$page->status" /></td>
                            <td class="text-right">
                                @can('pages.edit')
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('pages.delete')
                                    <x-admin.delete-button :route="route('admin.pages.destroy', $page)" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
