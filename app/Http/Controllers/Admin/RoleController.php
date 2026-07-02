<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasModulePermissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Services\RoleService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{
    use HasModulePermissions;

    public function __construct(protected RoleService $service)
    {
    }

    public static function permissionModule(): string
    {
        return 'roles';
    }

    public function index(): View
    {
        return view('admin.roles.index', [
            'roles' => $this->service->all(),
            'service' => $this->service,
        ]);
    }

    public function create(): View
    {
        return view('admin.roles.create', [
            'permissionGroups' => $this->service->permissionsGroupedByModule(),
        ]);
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $this->service->create($request->validated(), $request->input('permissions', []));

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role): View
    {
        return view('admin.roles.edit', [
            'role' => $role->load('permissions'),
            'permissionGroups' => $this->service->permissionsGroupedByModule(),
            'isProtected' => $this->service->isProtected($role),
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $this->service->update($role, $request->validated(), $request->input('permissions', []));

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if (! $this->service->delete($role)) {
            return back()->with('error', 'This role is protected and cannot be deleted.');
        }

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}
