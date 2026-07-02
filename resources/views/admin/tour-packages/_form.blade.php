@php
    $package = $package ?? null;
@endphp

<div class="row">
    <div class="col-md-6 form-group">
        <label>Name <span class="text-danger">*</span></label>
        <input type="text" name="name" value="{{ old('name', $package?->name) }}" class="form-control @error('name') is-invalid @enderror" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Destination <span class="text-danger">*</span></label>
        <input type="text" name="destination" value="{{ old('destination', $package?->destination) }}" class="form-control @error('destination') is-invalid @enderror" required>
        @error('destination') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 form-group">
        <label>Duration <span class="text-danger">*</span></label>
        <input type="text" name="duration" value="{{ old('duration', $package?->duration) }}" placeholder="5 Days / 4 Nights" class="form-control @error('duration') is-invalid @enderror" required>
        @error('duration') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 form-group">
        <label>Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $package?->price) }}" class="form-control @error('price') is-invalid @enderror">
        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 form-group">
        <label>Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="active" @selected(old('status', $package?->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $package?->status) === 'inactive')>Inactive</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12 form-group">
        <label>Description</label>
        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $package?->description) }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Inclusions <small class="text-muted">(one per line)</small></label>
        <textarea name="inclusions" rows="4" class="form-control @error('inclusions') is-invalid @enderror">{{ old('inclusions', $package?->inclusions) }}</textarea>
        @error('inclusions') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Exclusions <small class="text-muted">(one per line)</small></label>
        <textarea name="exclusions" rows="4" class="form-control @error('exclusions') is-invalid @enderror">{{ old('exclusions', $package?->exclusions) }}</textarea>
        @error('exclusions') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <x-admin.image-input name="featured_image" label="Featured Image" :current="$package?->featured_image" />
    </div>

    <div class="col-md-6 form-group">
        <label>Gallery Images</label>
        <input type="file" name="gallery[]" multiple accept="image/*" class="form-control-file @error('gallery.*') is-invalid @enderror">
        @error('gallery.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        <small class="text-muted">You can select multiple images. They will be added to the existing gallery.</small>
    </div>

    @if ($package && $package->images->isNotEmpty())
        <div class="col-md-12">
            <label>Current Gallery</label>
            <div class="d-flex flex-wrap">
                @foreach ($package->images as $image)
                    <div class="position-relative mr-2 mb-2">
                        <img src="{{ asset('storage/'.$image->image_path) }}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                        <form action="{{ route('admin.tour-packages.gallery.destroy', [$package, $image]) }}" method="POST" class="position-absolute" style="top: -8px; right: -8px;" onsubmit="return confirm('Remove this image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm rounded-circle" style="padding: 0.1rem 0.4rem;"><i class="fas fa-times"></i></button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
