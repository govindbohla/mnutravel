@php
    $enquiry = $enquiry ?? null;
@endphp

<div class="row">
    <div class="col-md-6 form-group">
        <label>Name <span class="text-danger">*</span></label>
        <input type="text" name="name" value="{{ old('name', $enquiry?->name) }}" class="form-control @error('name') is-invalid @enderror" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Phone <span class="text-danger">*</span></label>
        <input type="text" name="phone" value="{{ old('phone', $enquiry?->phone) }}" class="form-control @error('phone') is-invalid @enderror" required>
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $enquiry?->email) }}" class="form-control @error('email') is-invalid @enderror">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            @foreach (['new', 'contacted', 'interested', 'follow_up', 'converted', 'closed'] as $status)
                <option value="{{ $status }}" @selected(old('status', $enquiry?->status ?? 'new') === $status)>{{ ucwords(str_replace('_',' ',$status)) }}</option>
            @endforeach
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12 form-group">
        <label>Message</label>
        <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror">{{ old('message', $enquiry?->message) }}</textarea>
        @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
