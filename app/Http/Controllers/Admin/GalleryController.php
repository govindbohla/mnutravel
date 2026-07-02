<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasModulePermissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gallery\StoreGalleryRequest;
use App\Http\Requests\Admin\Gallery\UpdateGalleryRequest;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class GalleryController extends Controller implements HasMiddleware
{
    use HasModulePermissions;

    public function __construct(protected GalleryService $service)
    {
    }

    public static function permissionModule(): string
    {
        return 'gallery';
    }

    public function index(): View
    {
        return view('admin.gallery.index', [
            'items' => $this->service->all(),
        ]);
    }

    public function create(): View
    {
        return view('admin.gallery.create');
    }

    public function store(StoreGalleryRequest $request): RedirectResponse
    {
        $this->service->create($request->safe()->except('image'), $request->file('image'));

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image added successfully.');
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.gallery.edit', ['item' => $gallery]);
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $this->service->update($gallery, $request->safe()->except('image'), $request->file('image'));

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        $this->service->delete($gallery);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image deleted successfully.');
    }
}
