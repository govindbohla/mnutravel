<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Seo\UpdateSeoMetaRequest;
use App\Services\SeoMetaService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SeoController extends Controller implements HasMiddleware
{
    public function __construct(protected SeoMetaService $service)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('permission:seo.view', only: ['index', 'edit']),
            new Middleware('permission:seo.edit', only: ['update']),
        ];
    }

    public function index(): View
    {
        return view('admin.seo.index', [
            'seoables' => $this->service->allSeoables(),
        ]);
    }

    public function edit(string $type, int $id): View
    {
        $model = $this->service->findModel($type, $id);

        return view('admin.seo.edit', [
            'type' => $type,
            'model' => $model,
            'label' => $model->name ?? $model->title,
        ]);
    }

    public function update(UpdateSeoMetaRequest $request, string $type, int $id): RedirectResponse
    {
        $model = $this->service->findModel($type, $id);

        $this->service->update($model, $request->validated());

        return redirect()->route('admin.seo.index')->with('success', 'SEO details updated successfully.');
    }
}
