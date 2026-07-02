@php
    $customer = $customer ?? null;
@endphp

<div class="row">
    <div class="col-md-6 form-group">
        <label>Name <span class="text-danger">*</span></label>
        <input type="text" name="name" value="{{ old('name', $customer?->name) }}" class="form-control @error('name') is-invalid @enderror" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Phone <span class="text-danger">*</span></label>
        <input type="text" name="phone" value="{{ old('phone', $customer?->phone) }}" class="form-control @error('phone') is-invalid @enderror" required>
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $customer?->email) }}" class="form-control @error('email') is-invalid @enderror">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="active" @selected(old('status', $customer?->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $customer?->status) === 'inactive')>Inactive</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12 form-group">
        <label>Address</label>
        <textarea name="address" rows="2" class="form-control @error('address') is-invalid @enderror">{{ old('address', $customer?->address) }}</textarea>
        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12 form-group">
        <label>Notes</label>
        <textarea name="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $customer?->notes) }}</textarea>
        @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
