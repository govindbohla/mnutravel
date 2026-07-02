@extends('admin.layouts.app')

@section('content_header')
    <h1>Hero Sliders</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            @can('hero-sliders.create')
                <a href="{{ route('admin.hero-sliders.create') }}" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus"></i> Add Slide
                </a>
            @endcan
        </div>

        <div class="card-body">
            <table class="table table-striped admin-datatable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Button</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                        <tr>
                            <td><x-admin.thumb :src="$slider->image" /></td>
                            <td>{{ $slider->title }}</td>
                            <td>{{ $slider->button_text ?? '—' }}</td>
                            <td>{{ $slider->sort_order }}</td>
                            <td><x-admin.status-badge :status="$slider->status" /></td>
                            <td class="text-right">
                                @can('hero-sliders.edit')
                                    <a href="{{ route('admin.hero-sliders.edit', $slider) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('hero-sliders.delete')
                                    <x-admin.delete-button :route="route('admin.hero-sliders.destroy', $slider)" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
