<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request): View
    {
        $vehicles = Vehicle::active()
            ->with('category')
            ->when($request->filled('category'), fn ($q) => $q->whereHas('category', fn ($q) => $q->where('slug', $request->input('category'))))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('front.vehicles.index', [
            'vehicles' => $vehicles,
            'categories' => VehicleCategory::active()->orderBy('name')->get(),
        ]);
    }

    public function show(Vehicle $vehicle): View
    {
        abort_unless($vehicle->status === 'active', 404);

        return view('front.vehicles.show', [
            'vehicle' => $vehicle->load(['category', 'images']),
            'relatedVehicles' => Vehicle::active()
                ->where('vehicle_category_id', $vehicle->vehicle_category_id)
                ->where('id', '!=', $vehicle->id)
                ->take(3)
                ->get(),
        ]);
    }
}
