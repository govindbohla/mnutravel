<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasModulePermissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TourPackage\StoreTourPackageRequest;
use App\Http\Requests\Admin\TourPackage\UpdateTourPackageRequest;
use App\Models\TourPackage;
use App\Models\TourPackageImage;
use App\Services\TourPackageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class TourPackageController extends Controller implements HasMiddleware
{
    use HasModulePermissions;

    public function __construct(protected TourPackageService $service)
    {
    }

    public static function permissionModule(): string
    {
        return 'tour-packages';
    }

    public function index(): View
    {
        return view('admin.tour-packages.index', [
            'packages' => $this->service->all(),
        ]);
    }

    public function create(): View
    {
        return view('admin.tour-packages.create');
    }

    public function store(StoreTourPackageRequest $request): RedirectResponse
    {
        $this->service->create($request->safe()->except(['featured_image', 'gallery']), $request->file('featured_image'), $request->file('gallery', []));

        return redirect()->route('admin.tour-packages.index')->with('success', 'Tour package created successfully.');
    }

    public function edit(TourPackage $tourPackage): View
    {
        return view('admin.tour-packages.edit', [
            'package' => $tourPackage->load('images'),
        ]);
    }

    public function update(UpdateTourPackageRequest $request, TourPackage $tourPackage): RedirectResponse
    {
        $this->service->update($tourPackage, $request->safe()->except(['featured_image', 'gallery']), $request->file('featured_image'), $request->file('gallery', []));

        return redirect()->route('admin.tour-packages.index')->with('success', 'Tour package updated successfully.');
    }

    public function destroy(TourPackage $tourPackage): RedirectResponse
    {
        $this->service->delete($tourPackage);

        return redirect()->route('admin.tour-packages.index')->with('success', 'Tour package deleted successfully.');
    }

    public function destroyGalleryImage(TourPackage $tourPackage, TourPackageImage $image): RedirectResponse
    {
        abort_unless($image->tour_package_id === $tourPackage->id, 404);
        abort_unless(auth()->user()->can('tour-packages.edit'), 403);

        $this->service->deleteGalleryImage($image);

        return back()->with('success', 'Gallery image removed.');
    }
}
