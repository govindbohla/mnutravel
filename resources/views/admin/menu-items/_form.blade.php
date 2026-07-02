@php
    $item = $item ?? null;
@endphp

<div class="row">
    <div class="col-md-6 form-group">
        <label>Label <span class="text-danger">*</span></label>
        <input type="text" name="label" value="{{ old('label', $item?->label) }}" class="form-control @error('label') is-invalid @enderror" required>
        @error('label') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Parent Item</label>
        <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
            <option value="">-- None (Top Level) --</option>
            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}" @selected((string) old('parent_id', $item?->parent_id) === (string) $parent->id)>{{ $parent->label }}</option>
            @endforeach
        </select>
        @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Link to Page</label>
        <select name="page_id" class="form-control @error('page_id') is-invalid @enderror">
            <option value="">-- None --</option>
            @foreach ($pages as $page)
                <option value="{{ $page->id }}" @selected((string) old('page_id', $item?->page_id) === (string) $page->id)>{{ $page->title }}</option>
            @endforeach
        </select>
        @error('page_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <small class="text-muted">Or leave empty and enter a custom URL below.</small>
    </div>

    <div class="col-md-6 form-group">
        <label>Custom URL</label>
        <input type="text" name="url" value="{{ old('url', $item?->url) }}" class="form-control @error('url') is-invalid @enderror" placeholder="/our-cars or https://example.com">
        @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 form-group">
        <label>Target <span class="text-danger">*</span></label>
        <select name="target" class="form-control @error('target') is-invalid @enderror" required>
            <option value="_self" @selected(old('target', $item?->target ?? '_self') === '_self')>Same Tab</option>
            <option value="_blank" @selected(old('target', $item?->target) === '_blank')>New Tab</option>
        </select>
        @error('target') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $item?->sort_order ?? 0) }}" class="form-control @error('sort_order') is-invalid @enderror">
        @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 form-group">
        <label>Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="active" @selected(old('status', $item?->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $item?->status) === 'inactive')>Inactive</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
