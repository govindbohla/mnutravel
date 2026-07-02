@php
    $vehicle = $vehicle ?? null;
@endphp

<div class="row">
    <div class="col-md-6 form-group">
        <label>Vehicle Category <span class="text-danger">*</span></label>
        <select name="vehicle_category_id" class="form-control @error('vehicle_category_id') is-invalid @enderror" required>
            <option value="">-- Select Category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((string) old('vehicle_category_id', $vehicle?->vehicle_category_id) === (string) $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('vehicle_category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Name <span class="text-danger">*</span></label>
        <input type="text" name="name" value="{{ old('name', $vehicle?->name) }}" class="form-control @error('name') is-invalid @enderror" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 form-group">
        <label>Passenger Capacity <span class="text-danger">*</span></label>
        <input type="number" name="passenger_capacity" min="1" value="{{ old('passenger_capacity', $vehicle?->passenger_capacity ?? 4) }}" class="form-control @error('passenger_capacity') is-invalid @enderror" required>
        @error('passenger_capacity') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 form-group">
        <label>Luggage Capacity <span class="text-danger">*</span></label>
        <input type="number" name="luggage_capacity" min="0" value="{{ old('luggage_capacity', $vehicle?->luggage_capacity ?? 2) }}" class="form-control @error('luggage_capacity') is-invalid @enderror" required>
        @error('luggage_capacity') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 form-group">
        <label>Price (per day)</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $vehicle?->price) }}" class="form-control @error('price') is-invalid @enderror">
        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 form-group">
        <label>Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="active" @selected(old('status', $vehicle?->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $vehicle?->status) === 'inactive')>Inactive</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12 form-group">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="is_ac" value="1" id="is_ac" class="custom-control-input" @checked(old('is_ac', $vehicle?->is_ac ?? true))>
            <label class="custom-control-label" for="is_ac">Air Conditioned</label>
        </div>
    </div>

    <div class="col-md-12 form-group">
        <label>Description</label>
        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $vehicle?->description) }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <x-admin.image-input name="image" label="Featured Image" :current="$vehicle?->image" />
    </div>

    <div class="col-md-6 form-group">
        <label>Gallery Images</label>
        <input type="file" name="gallery[]" multiple accept="image/*" class="form-control-file @error('gallery.*') is-invalid @enderror">
        @error('gallery.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        <small class="text-muted">You can select multiple images. They will be added to the existing gallery.</small>
    </div>

    @if ($vehicle && $vehicle->images->isNotEmpty())
        <div class="col-md-12">
            <label>Current Gallery</label>
            <div class="d-flex flex-wrap">
                @foreach ($vehicle->images as $image)
                    <div class="position-relative mr-2 mb-2">
                        <img src="{{ asset('storage/'.$image->image_path) }}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                        <form action="{{ route('admin.vehicles.gallery.destroy', [$vehicle, $image]) }}" method="POST" class="position-absolute" style="top: -8px; right: -8px;" onsubmit="return confirm('Remove this image?');">
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
