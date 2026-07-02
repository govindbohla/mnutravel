@extends('admin.layouts.app')

@section('content_header')
    <h1>Services</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            @can('services.create')
                <a href="{{ route('admin.services.create') }}" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus"></i> Add Service
                </a>
            @endcan
        </div>

        <div class="card-body">
            <table class="table table-striped admin-datatable">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Short Description</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>@if($service->icon)<i class="{{ $service->icon }} fa-lg"></i>@endif</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ Str::limit($service->short_description, 60) }}</td>
                            <td>{{ $service->sort_order }}</td>
                            <td><x-admin.status-badge :status="$service->status" /></td>
                            <td class="text-right">
                                @can('services.edit')
                                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('services.delete')
                                    <x-admin.delete-button :route="route('admin.services.destroy', $service)" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
