@php
    $editUser = $editUser ?? null;
@endphp

<div class="row">
    <div class="col-md-6 form-group">
        <label>Name <span class="text-danger">*</span></label>
        <input type="text" name="name" value="{{ old('name', $editUser?->name) }}" class="form-control @error('name') is-invalid @enderror" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Email <span class="text-danger">*</span></label>
        <input type="email" name="email" value="{{ old('email', $editUser?->email) }}" class="form-control @error('email') is-invalid @enderror" required>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $editUser?->phone) }}" class="form-control @error('phone') is-invalid @enderror">
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="active" @selected(old('status', $editUser?->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $editUser?->status) === 'inactive')>Inactive</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Password {!! $editUser ? '<small class="text-muted">(leave blank to keep current)</small>' : '<span class="text-danger">*</span>' !!}</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
    </div>

    <div class="col-md-12 form-group">
        <label>Roles <span class="text-danger">*</span></label>
        <div>
            @foreach ($roles as $role)
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" id="role-{{ $role->id }}" class="custom-control-input"
                        @checked(in_array($role->name, old('roles', $editUser?->roles->pluck('name')->toArray() ?? [])))>
                    <label class="custom-control-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                </div>
            @endforeach
        </div>
        @error('roles') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
</div>
