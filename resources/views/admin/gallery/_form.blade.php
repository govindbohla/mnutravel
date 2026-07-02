@php
    $item = $item ?? null;
@endphp

<div class="row">
    <div class="col-md-6 form-group">
        <label>Title</label>
        <input type="text" name="title" value="{{ old('title', $item?->title) }}" class="form-control @error('title') is-invalid @enderror">
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 form-group">
        <label>Category</label>
        <input type="text" name="category" value="{{ old('category', $item?->category) }}" class="form-control @error('category') is-invalid @enderror" placeholder="e.g. Vehicles, Events">
        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 form-group">
        <label>Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="active" @selected(old('status', $item?->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $item?->status) === 'inactive')>Inactive</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <x-admin.image-input name="image" label="Image" :current="$item?->image" :required="! $item" />
    </div>
</div>
