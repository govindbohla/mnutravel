@php
    $faq = $faq ?? null;
@endphp

<div class="row">
    <div class="col-md-8 form-group">
        <label>Question <span class="text-danger">*</span></label>
        <input type="text" name="question" value="{{ old('question', $faq?->question) }}" class="form-control @error('question') is-invalid @enderror" required>
        @error('question') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-2 form-group">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $faq?->sort_order ?? 0) }}" class="form-control @error('sort_order') is-invalid @enderror">
        @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-2 form-group">
        <label>Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="active" @selected(old('status', $faq?->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $faq?->status) === 'inactive')>Inactive</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12 form-group">
        <label>Answer <span class="text-danger">*</span></label>
        <textarea name="answer" rows="4" class="form-control @error('answer') is-invalid @enderror" required>{{ old('answer', $faq?->answer) }}</textarea>
        @error('answer') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
