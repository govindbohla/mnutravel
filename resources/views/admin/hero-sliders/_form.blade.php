@php
    $slider = $slider ?? null;
@endphp

<div class="row">
    <div class="col-md-6 form-group">
        <label>Title <span class="text-danger">*</span></label>
        <input type="text" name="title" value="{{ old('title', $slider?->title) }}" class="form-control @error('title') is-invalid @enderror" required>
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Subtitle</label>
        <input type="text" name="subtitle" value="{{ old('subtitle', $slider?->subtitle) }}" class="form-control @error('subtitle') is-invalid @enderror">
        @error('subtitle') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 form-group">
        <label>Button Text</label>
        <input type="text" name="button_text" value="{{ old('button_text', $slider?->button_text) }}" class="form-control @error('button_text') is-invalid @enderror" placeholder="Book Now">
        @error('button_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 form-group">
        <label>Button Link</label>
        <input type="text" name="button_link" value="{{ old('button_link', $slider?->button_link) }}" class="form-control @error('button_link') is-invalid @enderror" placeholder="/tour-packages">
        @error('button_link') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-2 form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $slider?->sort_order ?? 0) }}" class="form-control @error('sort_order') is-invalid @enderror">
        @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-2 form-group">
        <label>Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="active" @selected(old('status', $slider?->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $slider?->status) === 'inactive')>Inactive</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <x-admin.image-input name="image" label="Slide Image" :current="$slider?->image" :required="! $slider" />
    </div>
</div>
