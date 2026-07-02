@extends('admin.layouts.app')

@section('content_header')
    <h1>Testimonials</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <div class="card-header">
            @can('testimonials.create')
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-sm btn-primary float-right">
                    <i class="fas fa-plus"></i> Add Testimonial
                </a>
            @endcan
        </div>

        <div class="card-body">
            <table class="table table-striped admin-datatable">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Customer</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testimonials as $testimonial)
                        <tr>
                            <td><x-admin.thumb :src="$testimonial->image" /></td>
                            <td>{{ $testimonial->customer_name }}</td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </td>
                            <td>{{ Str::limit($testimonial->review, 60) }}</td>
                            <td><x-admin.status-badge :status="$testimonial->status" /></td>
                            <td class="text-right">
                                @can('testimonials.edit')
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('testimonials.delete')
                                    <x-admin.delete-button :route="route('admin.testimonials.destroy', $testimonial)" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
