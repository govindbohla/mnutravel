@extends('admin.layouts.app')

@section('content_header')
    <h1>SEO - {{ $label }}</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.seo.update', [$type, $model->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $model->seoMeta?->meta_title) }}" class="form-control @error('meta_title') is-invalid @enderror">
                        @error('meta_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $model->seoMeta?->meta_keywords) }}" class="form-control @error('meta_keywords') is-invalid @enderror">
                        @error('meta_keywords') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12 form-group">
                        <label>Meta Description</label>
                        <textarea name="meta_description" rows="3" maxlength="500" class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $model->seoMeta?->meta_description) }}</textarea>
                        @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12 form-group">
                        <label>Canonical URL</label>
                        <input type="text" name="canonical_url" value="{{ old('canonical_url', $model->seoMeta?->canonical_url) }}" class="form-control @error('canonical_url') is-invalid @enderror">
                        @error('canonical_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save SEO Details</button>
                <a href="{{ route('admin.seo.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@stop
