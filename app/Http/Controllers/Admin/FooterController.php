<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasModulePermissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Footer\StoreFooterItemRequest;
use App\Http\Requests\Admin\Footer\UpdateFooterItemRequest;
use App\Models\MenuItem;
use App\Models\Page;
use App\Services\MenuItemService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FooterController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    use HasModulePermissions;

    protected const LOCATION = 'footer';
    protected const ROUTE_PREFIX = 'admin.footer';
    protected const PAGE_TITLE = 'Footer Manager';

    public function __construct(protected MenuItemService $service)
    {
    }

    public static function permissionModule(): string
    {
        return 'footer';
    }

    public function index(): View
    {
        return view('admin.menu-items.index', [
            'items' => $this->service->items(self::LOCATION),
            'routePrefix' => self::ROUTE_PREFIX,
            'pageTitle' => self::PAGE_TITLE,
        ]);
    }

    public function create(): View
    {
        return view('admin.menu-items.create', [
            'pages' => Page::active()->orderBy('title')->get(),
            'parents' => $this->service->items(self::LOCATION)->whereNull('parent_id'),
            'routePrefix' => self::ROUTE_PREFIX,
            'pageTitle' => self::PAGE_TITLE,
        ]);
    }

    public function store(StoreFooterItemRequest $request): RedirectResponse
    {
        $this->service->create(self::LOCATION, $request->validated());

        return redirect()->route('admin.footer.index')->with('success', 'Footer link created successfully.');
    }

    public function edit(MenuItem $footer): View
    {
        return view('admin.menu-items.edit', [
            'item' => $footer,
            'pages' => Page::active()->orderBy('title')->get(),
            'parents' => $this->service->items(self::LOCATION)->whereNull('parent_id')->where('id', '!=', $footer->id),
            'routePrefix' => self::ROUTE_PREFIX,
            'pageTitle' => self::PAGE_TITLE,
        ]);
    }

    public function update(UpdateFooterItemRequest $request, MenuItem $footer): RedirectResponse
    {
        $this->service->update($footer, $request->validated());

        return redirect()->route('admin.footer.index')->with('success', 'Footer link updated successfully.');
    }

    public function destroy(MenuItem $footer): RedirectResponse
    {
        $this->service->delete($footer);

        return redirect()->route('admin.footer.index')->with('success', 'Footer link deleted successfully.');
    }
}
