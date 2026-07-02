<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactDetail\UpdateContactDetailRequest;
use App\Services\ContactDetailService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ContactDetailController extends Controller implements HasMiddleware
{
    public function __construct(protected ContactDetailService $service)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('permission:contact.view', only: ['edit']),
            new Middleware('permission:contact.edit', only: ['update']),
        ];
    }

    public function edit(): View
    {
        return view('admin.contact-details.edit', [
            'contactDetail' => $this->service->current(),
        ]);
    }

    public function update(UpdateContactDetailRequest $request): RedirectResponse
    {
        $this->service->update($request->validated());

        return redirect()->route('admin.contact-details.edit')->with('success', 'Contact details updated successfully.');
    }
}
