<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasModulePermissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\StoreMenuItemRequest;
use App\Http\Requests\Admin\Menu\UpdateMenuItemRequest;
use App\Models\MenuItem;
use App\Models\Page;
use App\Services\MenuItemService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MenuController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    use HasModulePermissions;

    protected const LOCATION = 'header';
    protected const ROUTE_PREFIX = 'admin.menus';
    protected const PAGE_TITLE = 'Menu Manager';

    public function __construct(protected MenuItemService $service)
    {
    }

    public static function permissionModule(): string
    {
        return 'menus';
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

    public function store(StoreMenuItemRequest $request): RedirectResponse
    {
        $this->service->create(self::LOCATION, $request->validated());

        return redirect()->route('admin.menus.index')->with('success', 'Menu item created successfully.');
    }

    public function edit(MenuItem $menu): View
    {
        return view('admin.menu-items.edit', [
            'item' => $menu,
            'pages' => Page::active()->orderBy('title')->get(),
            'parents' => $this->service->items(self::LOCATION)->whereNull('parent_id')->where('id', '!=', $menu->id),
            'routePrefix' => self::ROUTE_PREFIX,
            'pageTitle' => self::PAGE_TITLE,
        ]);
    }

    public function update(UpdateMenuItemRequest $request, MenuItem $menu): RedirectResponse
    {
        $this->service->update($menu, $request->validated());

        return redirect()->route('admin.menus.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menu): RedirectResponse
    {
        $this->service->delete($menu);

        return redirect()->route('admin.menus.index')->with('success', 'Menu item deleted successfully.');
    }
}
