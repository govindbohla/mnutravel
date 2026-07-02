@props(['route', 'label' => 'Delete'])

<form action="{{ $route }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this? This can be restored later if needed.');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" title="{{ $label }}">
        <i class="fas fa-trash"></i>
    </button>
</form>
