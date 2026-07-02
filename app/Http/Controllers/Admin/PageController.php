<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasModulePermissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Page\StorePageRequest;
use App\Http\Requests\Admin\Page\UpdatePageRequest;
use App\Models\Page;
use App\Services\PageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class PageController extends Controller implements HasMiddleware
{
    use HasModulePermissions;

    public function __construct(protected PageService $service)
    {
    }

    public static function permissionModule(): string
    {
        return 'pages';
    }

    public function index(): View
    {
        return view('admin.pages.index', [
            'pages' => $this->service->all(),
        ]);
    }

    public function create(): View
    {
        return view('admin.pages.create');
    }

    public function store(StorePageRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $this->service->update($page, $request->validated());

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $this->service->delete($page);

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
