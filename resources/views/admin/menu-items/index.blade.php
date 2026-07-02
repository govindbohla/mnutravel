@extends('admin.layouts.app')

@section('content_header')
    <h1>{{ $pageTitle }}</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            <a href="{{ route($routePrefix.'.create') }}" class="btn btn-sm btn-primary float-right">
                <i class="fas fa-plus"></i> Add Item
            </a>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Link</th>
                        <th>Target</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ $item->parent_id ? '— ' : '' }}{{ $item->label }}</td>
                            <td>{{ $item->page ? '/'.$item->page->slug.' (page)' : ($item->url ?? '—') }}</td>
                            <td>{{ $item->target === '_blank' ? 'New Tab' : 'Same Tab' }}</td>
                            <td>{{ $item->sort_order }}</td>
                            <td><x-admin.status-badge :status="$item->status" /></td>
                            <td class="text-right">
                                <a href="{{ route($routePrefix.'.edit', $item) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <x-admin.delete-button :route="route($routePrefix.'.destroy', $item)" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No items yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
