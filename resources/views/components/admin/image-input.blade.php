@props(['name' => 'image', 'label' => 'Image', 'current' => null, 'required' => false])

<div class="form-group">
    <label>{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>

    @if ($current)
        <div class="mb-2">
            <img src="{{ asset('storage/'.$current) }}" class="img-thumbnail" style="max-height: 100px;">
        </div>
    @endif

    <input type="file" name="{{ $name }}" accept="image/*" class="form-control-file @error($name) is-invalid @enderror">
    @error($name) <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    <small class="text-muted">JPG, PNG or WEBP. Leave empty to keep the current image.</small>
</div>
