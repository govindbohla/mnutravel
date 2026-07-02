@php
    $service = $service ?? null;
@endphp

<div class="row">
    <div class="col-md-6 form-group">
        <label>Name <span class="text-danger">*</span></label>
        <input type="text" name="name" value="{{ old('name', $service?->name) }}" class="form-control @error('name') is-invalid @enderror" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 form-group">
        <label>Icon (Font Awesome class)</label>
        <input type="text" name="icon" value="{{ old('icon', $service?->icon) }}" class="form-control @error('icon') is-invalid @enderror" placeholder="fa-solid fa-plane">
        @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $service?->sort_order ?? 0) }}" class="form-control @error('sort_order') is-invalid @enderror">
        @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Short Description</label>
        <input type="text" name="short_description" value="{{ old('short_description', $service?->short_description) }}" maxlength="500" class="form-control @error('short_description') is-invalid @enderror">
        @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="active" @selected(old('status', $service?->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $service?->status) === 'inactive')>Inactive</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12 form-group">
        <label>Full Description</label>
        <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description', $service?->description) }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <x-admin.image-input name="image" label="Image" :current="$service?->image" />
    </div>
</div>
