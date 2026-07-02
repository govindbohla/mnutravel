<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasModulePermissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\StoreCustomerRequest;
use App\Http\Requests\Admin\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class CustomerController extends Controller implements HasMiddleware
{
    use HasModulePermissions;

    public function __construct(protected CustomerService $service)
    {
    }

    public static function permissionModule(): string
    {
        return 'customers';
    }

    public function index(Request $request): View
    {
        $customers = $this->service->paginate($request->only(['search']));

        return view('admin.customers.index', [
            'customers' => $customers,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create(): View
    {
        return view('admin.customers.create');
    }

    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully.');
    }

    public function edit(Customer $customer): View
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        $this->service->update($customer, $request->validated());

        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        $this->service->delete($customer);

        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully.');
    }
}
