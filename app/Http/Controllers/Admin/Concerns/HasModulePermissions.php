<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Routing\Controllers\Middleware;

/**
 * Gates the standard resource actions behind {module}.{view,create,edit,delete}
 * permissions. Controllers using this trait must implement permissionModule().
 */
trait HasModulePermissions
{
    abstract public static function permissionModule(): string;

    public static function middleware(): array
    {
        $module = static::permissionModule();

        return [
            new Middleware("permission:{$module}.view", only: ['index', 'show']),
            new Middleware("permission:{$module}.create", only: ['create', 'store']),
            new Middleware("permission:{$module}.edit", only: ['edit', 'update']),
            new Middleware("permission:{$module}.delete", only: ['destroy']),
        ];
    }
}
