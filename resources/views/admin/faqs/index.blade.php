@extends('admin.layouts.app')

@section('content_header')
    <h1>FAQ</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            @can('faqs.create')
                <a href="{{ route('admin.faqs.create') }}" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus"></i> Add FAQ
                </a>
            @endcan
        </div>

        <div class="card-body">
            <table class="table table-striped admin-datatable">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faqs as $faq)
                        <tr>
                            <td>{{ $faq->question }}</td>
                            <td>{{ $faq->sort_order }}</td>
                            <td><x-admin.status-badge :status="$faq->status" /></td>
                            <td class="text-right">
                                @can('faqs.edit')
                                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('faqs.delete')
                                    <x-admin.delete-button :route="route('admin.faqs.destroy', $faq)" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
