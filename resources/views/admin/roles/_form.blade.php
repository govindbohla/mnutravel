@php
    $role = $role ?? null;
    $isProtected = $isProtected ?? false;
    $currentPermissions = old('permissions', $role?->permissions->pluck('name')->toArray() ?? []);
@endphp

<div class="row">
    <div class="col-md-6 form-group">
        <label>Role Name <span class="text-danger">*</span></label>
        <input type="text" name="name" value="{{ old('name', $role?->name) }}" class="form-control @error('name') is-invalid @enderror" @disabled($isProtected) required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if ($isProtected)
            <small class="text-muted">The Admin role name cannot be changed.</small>
        @endif
    </div>
</div>

<hr>
<h5 class="mb-3">Permissions</h5>

@foreach ($permissionGroups as $module => $permissions)
    <div class="mb-3">
        <strong class="text-capitalize">{{ str_replace('-', ' ', $module) }}</strong>
        <div>
            @foreach ($permissions as $permission)
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm-{{ $permission->id }}" class="custom-control-input"
                        @checked(in_array($permission->name, $currentPermissions))>
                    <label class="custom-control-label" for="perm-{{ $permission->id }}">{{ Str::after($permission->name, '.') }}</label>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
