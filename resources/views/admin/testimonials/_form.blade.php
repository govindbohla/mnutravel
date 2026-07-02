@php
    $testimonial = $testimonial ?? null;
@endphp

<div class="row">
    <div class="col-md-6 form-group">
        <label>Customer Name <span class="text-danger">*</span></label>
        <input type="text" name="customer_name" value="{{ old('customer_name', $testimonial?->customer_name) }}" class="form-control @error('customer_name') is-invalid @enderror" required>
        @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 form-group">
        <label>Rating <span class="text-danger">*</span></label>
        <select name="rating" class="form-control @error('rating') is-invalid @enderror" required>
            @for ($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}" @selected((string) old('rating', $testimonial?->rating ?? 5) === (string) $i)>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
            @endfor
        </select>
        @error('rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 form-group">
        <label>Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="active" @selected(old('status', $testimonial?->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $testimonial?->status) === 'inactive')>Inactive</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12 form-group">
        <label>Review <span class="text-danger">*</span></label>
        <textarea name="review" rows="4" class="form-control @error('review') is-invalid @enderror" required>{{ old('review', $testimonial?->review) }}</textarea>
        @error('review') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <x-admin.image-input name="image" label="Customer Photo" :current="$testimonial?->image" />
    </div>
</div>
