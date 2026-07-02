<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Collection;

class MenuItemService
{
    public function menuForLocation(string $location): Menu
    {
        return Menu::query()->firstOrCreate(
            ['location' => $location],
            ['name' => ucfirst($location).' Menu']
        );
    }

    public function items(string $location): Collection
    {
        return $this->menuForLocation($location)
            ->allItems()
            ->with('page')
            ->get();
    }

    public function create(string $location, array $data): MenuItem
    {
        $menu = $this->menuForLocation($location);

        return $menu->allItems()->create($data);
    }

    public function update(MenuItem $item, array $data): MenuItem
    {
        $item->update($data);

        return $item->fresh();
    }

    public function delete(MenuItem $item): bool
    {
        return (bool) $item->delete();
    }

    public function reorder(array $orderedIds): void
    {
        foreach ($orderedIds as $index => $id) {
            MenuItem::query()->where('id', $id)->update(['sort_order' => $index]);
        }
    }
}
