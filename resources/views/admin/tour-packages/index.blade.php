@extends('admin.layouts.app')

@section('content_header')
    <h1>Tour Packages</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            @can('tour-packages.create')
                <a href="{{ route('admin.tour-packages.create') }}" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus"></i> Add Package
                </a>
            @endcan
        </div>

        <div class="card-body">
            <table class="table table-striped admin-datatable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Destination</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $package)
                        <tr>
                            <td><x-admin.thumb :src="$package->featured_image" /></td>
                            <td>{{ $package->name }}</td>
                            <td>{{ $package->destination }}</td>
                            <td>{{ $package->duration }}</td>
                            <td>{{ $package->price ? '₹'.number_format($package->price, 0) : '—' }}</td>
                            <td><x-admin.status-badge :status="$package->status" /></td>
                            <td class="text-right">
                                @can('tour-packages.edit')
                                    <a href="{{ route('admin.tour-packages.edit', $package) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('tour-packages.delete')
                                    <x-admin.delete-button :route="route('admin.tour-packages.destroy', $package)" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
