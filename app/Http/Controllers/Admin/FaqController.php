<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasModulePermissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Faq\StoreFaqRequest;
use App\Http\Requests\Admin\Faq\UpdateFaqRequest;
use App\Models\Faq;
use App\Services\FaqService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class FaqController extends Controller implements HasMiddleware
{
    use HasModulePermissions;

    public function __construct(protected FaqService $service)
    {
    }

    public static function permissionModule(): string
    {
        return 'faqs';
    }

    public function index(): View
    {
        return view('admin.faqs.index', [
            'faqs' => $this->service->all(),
        ]);
    }

    public function create(): View
    {
        return view('admin.faqs.create');
    }

    public function store(StoreFaqRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(UpdateFaqRequest $request, Faq $faq): RedirectResponse
    {
        $this->service->update($faq, $request->validated());

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $this->service->delete($faq);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}
