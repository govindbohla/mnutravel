<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasModulePermissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleCategory\StoreVehicleCategoryRequest;
use App\Http\Requests\Admin\VehicleCategory\UpdateVehicleCategoryRequest;
use App\Models\VehicleCategory;
use App\Services\VehicleCategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class VehicleCategoryController extends Controller implements HasMiddleware
{
    use HasModulePermissions;

    public function __construct(protected VehicleCategoryService $service)
    {
    }

    public static function permissionModule(): string
    {
        return 'vehicle-categories';
    }

    public function index(): View
    {
        return view('admin.vehicle-categories.index', [
            'categories' => $this->service->all(),
        ]);
    }

    public function create(): View
    {
        return view('admin.vehicle-categories.create');
    }

    public function store(StoreVehicleCategoryRequest $request): RedirectResponse
    {
        $this->service->create($request->safe()->except('image'), $request->file('image'));

        return redirect()->route('admin.vehicle-categories.index')->with('success', 'Vehicle category created successfully.');
    }

    public function edit(VehicleCategory $vehicleCategory): View
    {
        return view('admin.vehicle-categories.edit', ['category' => $vehicleCategory]);
    }

    public function update(UpdateVehicleCategoryRequest $request, VehicleCategory $vehicleCategory): RedirectResponse
    {
        $this->service->update($vehicleCategory, $request->safe()->except('image'), $request->file('image'));

        return redirect()->route('admin.vehicle-categories.index')->with('success', 'Vehicle category updated successfully.');
    }

    public function destroy(VehicleCategory $vehicleCategory): RedirectResponse
    {
        $this->service->delete($vehicleCategory);

        return redirect()->route('admin.vehicle-categories.index')->with('success', 'Vehicle category deleted successfully.');
    }
}
