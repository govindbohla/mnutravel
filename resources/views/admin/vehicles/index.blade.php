@extends('admin.layouts.app')

@section('content_header')
    <h1>Vehicles</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            @can('vehicles.create')
                <a href="{{ route('admin.vehicles.create') }}" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus"></i> Add Vehicle
                </a>
            @endcan
        </div>

        <div class="card-body">
            <table class="table table-striped admin-datatable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Capacity</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <td><x-admin.thumb :src="$vehicle->image" /></td>
                            <td>{{ $vehicle->name }}</td>
                            <td>{{ $vehicle->category->name ?? '—' }}</td>
                            <td>{{ $vehicle->passenger_capacity }} Seats</td>
                            <td>{{ $vehicle->price ? '₹'.number_format($vehicle->price, 0) : '—' }}</td>
                            <td><x-admin.status-badge :status="$vehicle->status" /></td>
                            <td class="text-right">
                                @can('vehicles.edit')
                                    <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('vehicles.delete')
                                    <x-admin.delete-button :route="route('admin.vehicles.destroy', $vehicle)" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
