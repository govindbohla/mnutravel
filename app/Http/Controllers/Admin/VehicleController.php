<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasModulePermissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Admin\Vehicle\UpdateVehicleRequest;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Models\VehicleImage;
use App\Services\VehicleService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class VehicleController extends Controller implements HasMiddleware
{
    use HasModulePermissions;

    public function __construct(protected VehicleService $service)
    {
    }

    public static function permissionModule(): string
    {
        return 'vehicles';
    }

    public function index(): View
    {
        return view('admin.vehicles.index', [
            'vehicles' => $this->service->all(),
        ]);
    }

    public function create(): View
    {
        return view('admin.vehicles.create', [
            'categories' => VehicleCategory::active()->orderBy('name')->get(),
        ]);
    }

    public function store(StoreVehicleRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'gallery', 'is_ac']);
        $data['is_ac'] = $request->boolean('is_ac');

        $this->service->create($data, $request->file('image'), $request->file('gallery', []));

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    public function edit(Vehicle $vehicle): View
    {
        return view('admin.vehicles.edit', [
            'vehicle' => $vehicle->load('images'),
            'categories' => VehicleCategory::active()->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'gallery', 'is_ac']);
        $data['is_ac'] = $request->boolean('is_ac');

        $this->service->update($vehicle, $data, $request->file('image'), $request->file('gallery', []));

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        $this->service->delete($vehicle);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }

    public function destroyGalleryImage(Vehicle $vehicle, VehicleImage $image): RedirectResponse
    {
        abort_unless($image->vehicle_id === $vehicle->id, 404);
        abort_unless(auth()->user()->can('vehicles.edit'), 403);

        $this->service->deleteGalleryImage($image);

        return back()->with('success', 'Gallery image removed.');
    }
}
