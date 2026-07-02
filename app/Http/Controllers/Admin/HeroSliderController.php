<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasModulePermissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HeroSlider\StoreHeroSliderRequest;
use App\Http\Requests\Admin\HeroSlider\UpdateHeroSliderRequest;
use App\Models\HeroSlider;
use App\Services\HeroSliderService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class HeroSliderController extends Controller implements HasMiddleware
{
    use HasModulePermissions;

    public function __construct(protected HeroSliderService $service)
    {
    }

    public static function permissionModule(): string
    {
        return 'hero-sliders';
    }

    public function index(): View
    {
        return view('admin.hero-sliders.index', [
            'sliders' => $this->service->all(),
        ]);
    }

    public function create(): View
    {
        return view('admin.hero-sliders.create');
    }

    public function store(StoreHeroSliderRequest $request): RedirectResponse
    {
        $this->service->create($request->safe()->except('image'), $request->file('image'));

        return redirect()->route('admin.hero-sliders.index')->with('success', 'Hero slide created successfully.');
    }

    public function edit(HeroSlider $heroSlider): View
    {
        return view('admin.hero-sliders.edit', ['slider' => $heroSlider]);
    }

    public function update(UpdateHeroSliderRequest $request, HeroSlider $heroSlider): RedirectResponse
    {
        $this->service->update($heroSlider, $request->safe()->except('image'), $request->file('image'));

        return redirect()->route('admin.hero-sliders.index')->with('success', 'Hero slide updated successfully.');
    }

    public function destroy(HeroSlider $heroSlider): RedirectResponse
    {
        $this->service->delete($heroSlider);

        return redirect()->route('admin.hero-sliders.index')->with('success', 'Hero slide deleted successfully.');
    }
}
