@extends('admin.layouts.app')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            @can('users.create')
                <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus"></i> Add User
                </a>
            @endcan
        </div>

        <div class="card-body">
            <table class="table table-striped admin-datatable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    <span class="badge badge-info">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td><x-admin.status-badge :status="$user->status" /></td>
                            <td class="text-right">
                                @can('users.edit')
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('users.delete')
                                    @if ($user->id !== auth()->id())
                                        <x-admin.delete-button :route="route('admin.users.destroy', $user)" />
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
