@extends('admin.layouts.app')

@section('content_header')
    <h1>Enquiries</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            <form method="GET" class="form-inline">
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control form-control-sm mr-2" placeholder="Search name, phone, email...">

                <select name="status" class="form-control form-control-sm mr-2">
                    <option value="">All Statuses</option>
                    @foreach (['new', 'contacted', 'interested', 'follow_up', 'converted', 'closed'] as $status)
                        <option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>{{ ucwords(str_replace('_',' ',$status)) }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                <a href="{{ route('admin.enquiries.index') }}" class="btn btn-sm btn-outline-secondary ml-1">Reset</a>
            </form>

            @can('enquiries.create')
                <a href="{{ route('admin.enquiries.create') }}" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus"></i> Add Enquiry
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
                        <th>Message</th>
                        <th>Status</th>
                        <th>Received</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($enquiries as $enquiry)
                        <tr>
                            <td>{{ $enquiry->name }}</td>
                            <td>{{ $enquiry->phone }}</td>
                            <td>{{ $enquiry->email ?? '—' }}</td>
                            <td>{{ Str::limit($enquiry->message, 50) }}</td>
                            <td><x-admin.status-badge :status="$enquiry->status" /></td>
                            <td>{{ $enquiry->created_at->format('d M Y') }}</td>
                            <td class="text-right">
                                @can('enquiries.edit')
                                    <a href="{{ route('admin.enquiries.edit', $enquiry) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('enquiries.delete')
                                    <x-admin.delete-button :route="route('admin.enquiries.destroy', $enquiry)" />
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No enquiries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($enquiries->hasPages())
            <div class="card-footer">
                {{ $enquiries->links() }}
            </div>
        @endif
    </div>
@stop
