<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleService
{
    /**
     * Roles that are core to the system and cannot be deleted.
     */
    protected const PROTECTED_ROLES = ['Admin'];

    public function all(): Collection
    {
        return Role::withCount('permissions')->orderBy('name')->get();
    }

    public function permissionsGroupedByModule(): Collection
    {
        return Permission::orderBy('name')->get()->groupBy(function (Permission $permission) {
            return explode('.', $permission->name)[0];
        });
    }

    public function create(array $data, array $permissions): Role
    {
        $role = Role::create(['name' => $data['name'], 'guard_name' => 'web']);

        $role->syncPermissions($permissions);

        return $role;
    }

    public function update(Role $role, array $data, array $permissions): Role
    {
        if (! in_array($role->name, self::PROTECTED_ROLES)) {
            $role->update(['name' => $data['name']]);
        }

        $role->syncPermissions($permissions);

        return $role->fresh();
    }

    public function delete(Role $role): bool
    {
        if (in_array($role->name, self::PROTECTED_ROLES)) {
            return false;
        }

        return (bool) $role->delete();
    }

    public function isProtected(Role $role): bool
    {
        return in_array($role->name, self::PROTECTED_ROLES);
    }
}
