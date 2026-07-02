@extends('admin.layouts.app')

@section('content_header')
    <h1>Vehicle Categories</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            @can('vehicle-categories.create')
                <a href="{{ route('admin.vehicle-categories.create') }}" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus"></i> Add Category
                </a>
            @endcan
        </div>

        <div class="card-body">
            <table class="table table-striped admin-datatable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Vehicles</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td><x-admin.thumb :src="$category->image" /></td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->vehicles()->count() }}</td>
                            <td><x-admin.status-badge :status="$category->status" /></td>
                            <td class="text-right">
                                @can('vehicle-categories.edit')
                                    <a href="{{ route('admin.vehicle-categories.edit', $category) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('vehicle-categories.delete')
                                    <x-admin.delete-button :route="route('admin.vehicle-categories.destroy', $category)" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
