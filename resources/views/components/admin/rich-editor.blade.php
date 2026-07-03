@props(['name', 'value' => null, 'label' => null])

{{--
    Summernote's library (CSS/JS) is loaded once, globally, in
    admin/layouts/app.blade.php, and initialized via the shared
    initAdminWidgets() function so it also works after AJAX content
    swaps (see admin-nav.js). This component only needs to render
    the textarea markup.
--}}
<div class="form-group">
    @if ($label)
        <label>{{ $label }}</label>
    @endif
    <textarea name="{{ $name }}" class="summernote-editor form-control @error($name) is-invalid @enderror">{{ old($name, $value) }}</textarea>
    @error($name) <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
</div>
