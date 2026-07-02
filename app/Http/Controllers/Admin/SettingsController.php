<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\UpdateSettingsRequest;
use App\Services\WebsiteSettingsService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SettingsController extends Controller implements HasMiddleware
{
    public function __construct(protected WebsiteSettingsService $service)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('permission:settings.view', only: ['edit']),
            new Middleware('permission:settings.edit', only: ['update']),
        ];
    }

    public function edit(): View
    {
        return view('admin.settings.edit', [
            'settings' => $this->service->all(),
        ]);
    }

    public function update(UpdateSettingsRequest $request): RedirectResponse
    {
        $this->service->update(
            $request->safe()->except(['site_logo', 'site_favicon']),
            $request->file('site_logo'),
            $request->file('site_favicon'),
        );

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
