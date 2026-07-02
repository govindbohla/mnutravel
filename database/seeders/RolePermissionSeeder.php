<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Modules managed through the admin CRUD screens. Each gets
     * view/create/edit/delete permissions.
     */
    protected array $modules = [
        'bookings',
        'enquiries',
        'customers',
        'vehicles',
        'vehicle-categories',
        'services',
        'tour-packages',
        'testimonials',
        'faqs',
        'gallery',
        'hero-sliders',
        'pages',
        'menus',
        'footer',
        'seo',
        'contact',
        'settings',
        'users',
        'roles',
    ];

    public function run(): void
    {
        Cache::forget('spatie.permission.cache');

        $permissions = [];

        foreach ($this->modules as $module) {
            foreach (['view', 'create', 'edit', 'delete'] as $action) {
                $permissions[] = "{$module}.{$action}";
            }
        }

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $admin = Role::findOrCreate('Admin', 'web');
        $admin->syncPermissions($permissions);

        $subAdminModules = array_diff($this->modules, ['settings', 'users', 'roles']);
        $subAdminPermissions = $this->permissionsForModules($permissions, $subAdminModules);

        $subAdmin = Role::findOrCreate('Sub Admin', 'web');
        $subAdmin->syncPermissions($subAdminPermissions);

        $helplinerModules = ['bookings', 'enquiries', 'customers'];
        $helplinerPermissions = $this->permissionsForModules($permissions, $helplinerModules);

        $helpliner = Role::findOrCreate('Helpliner', 'web');
        $helpliner->syncPermissions($helplinerPermissions);
    }

    protected function permissionsForModules(array $permissions, array $modules): array
    {
        return array_values(array_filter($permissions, function (string $permission) use ($modules) {
            foreach ($modules as $module) {
                if (str_starts_with($permission, "{$module}.")) {
                    return true;
                }
            }

            return false;
        }));
    }
}
