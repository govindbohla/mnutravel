@extends('admin.layouts.app')

@section('content_header')
    <h1>Customers</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            <form method="GET" class="form-inline">
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control form-control-sm mr-2" placeholder="Search name, phone, email...">
                <button type="submit" class="btn btn-sm btn-primary">Search</button>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-outline-secondary ml-1">Reset</a>
            </form>

            @can('customers.create')
                <a href="{{ route('admin.customers.create') }}" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus"></i> Add Customer
                </a>
            @endcan
        </div>

        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Bookings</th>
                        <th>Enquiries</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->email ?? '—' }}</td>
                            <td>{{ $customer->bookings_count }}</td>
                            <td>{{ $customer->enquiries_count }}</td>
                            <td><x-admin.status-badge :status="$customer->status" /></td>
                            <td class="text-right">
                                @can('customers.edit')
                                    <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('customers.delete')
                                    <x-admin.delete-button :route="route('admin.customers.destroy', $customer)" />
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No customers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($customers->hasPages())
            <div class="card-footer">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
@stop
