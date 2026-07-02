@extends('admin.layouts.app')

@section('content_header')
    <h1>Gallery</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            @can('gallery.create')
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus"></i> Add Image
                </a>
            @endcan
        </div>

        <div class="card-body">
            <table class="table table-striped admin-datatable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td><x-admin.thumb :src="$item->image" /></td>
                            <td>{{ $item->title ?? '—' }}</td>
                            <td>{{ $item->category ?? '—' }}</td>
                            <td><x-admin.status-badge :status="$item->status" /></td>
                            <td class="text-right">
                                @can('gallery.edit')
                                    <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('gallery.delete')
                                    <x-admin.delete-button :route="route('admin.gallery.destroy', $item)" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
