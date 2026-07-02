@extends('admin.layouts.app')

@section('content_header')
    <h1>SEO Manager</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-body">
            <table class="table table-striped admin-datatable">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Title</th>
                        <th>SEO Configured</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seoables as $item)
                        <tr>
                            <td>{{ $item['type_label'] }}</td>
                            <td>{{ $item['label'] }}</td>
                            <td>
                                @if ($item['has_seo'])
                                    <span class="badge badge-success">Yes</span>
                                @else
                                    <span class="badge badge-secondary">No</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ route('admin.seo.edit', [$item['type'], $item['id']]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit SEO</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
