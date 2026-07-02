<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasModulePermissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Enquiry\StoreEnquiryRequest;
use App\Http\Requests\Admin\Enquiry\UpdateEnquiryRequest;
use App\Models\Enquiry;
use App\Services\EnquiryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class EnquiryController extends Controller implements HasMiddleware
{
    use HasModulePermissions;

    public function __construct(protected EnquiryService $service)
    {
    }

    public static function permissionModule(): string
    {
        return 'enquiries';
    }

    public function index(Request $request): View
    {
        $enquiries = $this->service->paginate($request->only(['status', 'search']));

        return view('admin.enquiries.index', [
            'enquiries' => $enquiries,
            'filters' => $request->only(['status', 'search']),
        ]);
    }

    public function create(): View
    {
        return view('admin.enquiries.create');
    }

    public function store(StoreEnquiryRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.enquiries.index')->with('success', 'Enquiry created successfully.');
    }

    public function edit(Enquiry $enquiry): View
    {
        return view('admin.enquiries.edit', compact('enquiry'));
    }

    public function update(UpdateEnquiryRequest $request, Enquiry $enquiry): RedirectResponse
    {
        $this->service->update($enquiry, $request->validated());

        return redirect()->route('admin.enquiries.index')->with('success', 'Enquiry updated successfully.');
    }

    public function destroy(Enquiry $enquiry): RedirectResponse
    {
        $this->service->delete($enquiry);

        return redirect()->route('admin.enquiries.index')->with('success', 'Enquiry deleted successfully.');
    }
}
