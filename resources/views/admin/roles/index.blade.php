@extends('admin.layouts.app')

@section('content_header')
    <h1>Roles &amp; Permissions</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            @can('roles.create')
                <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus"></i> Add Role
                </a>
            @endcan
        </div>

        <div class="card-body">
            <table class="table table-striped admin-datatable">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }} @if($service->isProtected($role))<span class="badge badge-secondary">Protected</span>@endif</td>
                            <td>{{ $role->permissions_count }}</td>
                            <td class="text-right">
                                @can('roles.edit')
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('roles.delete')
                                    @if (! $service->isProtected($role))
                                        <x-admin.delete-button :route="route('admin.roles.destroy', $role)" />
                                    @endif
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
