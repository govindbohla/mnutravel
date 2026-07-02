@props(['name', 'value' => null, 'label' => null])

<div class="form-group">
    @if ($label)
        <label>{{ $label }}</label>
    @endif
    <textarea name="{{ $name }}" class="summernote-editor form-control @error($name) is-invalid @enderror">{{ old($name, $value) }}</textarea>
    @error($name) <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
</div>

@once
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css" rel="stylesheet">
    @endpush
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
        <script>
            $(function () {
                $('.summernote-editor').summernote({
                    height: 300,
                });
            });
        </script>
    @endpush
@endonce
