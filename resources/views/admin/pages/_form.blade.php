@php
    $page = $page ?? null;
@endphp

<div class="row">
    <div class="col-md-8 form-group">
        <label>Title <span class="text-danger">*</span></label>
        <input type="text" name="title" value="{{ old('title', $page?->title) }}" class="form-control @error('title') is-invalid @enderror" required>
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if ($page)
            <small class="text-muted">Current URL: /{{ $page->slug }}</small>
        @endif
    </div>

    <div class="col-md-4 form-group">
        <label>Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="active" @selected(old('status', $page?->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $page?->status) === 'inactive')>Inactive</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <x-admin.rich-editor name="content" label="Content" :value="$page?->content" />
    </div>
</div>
