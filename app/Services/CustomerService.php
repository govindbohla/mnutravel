<?php

namespace App\Services;

use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CustomerService
{
    public function __construct(protected CustomerRepositoryInterface $repository)
    {
    }

    public function paginate(array $filters, int $perPage = 20): LengthAwarePaginator
    {
        return $this->repository->paginateFiltered($filters, $perPage);
    }

    public function create(array $data): Customer
    {
        /** @var Customer $customer */
        $customer = $this->repository->create($data);

        return $customer;
    }

    public function update(Customer $customer, array $data): Customer
    {
        /** @var Customer $updated */
        $updated = $this->repository->update($customer, $data);

        return $updated;
    }

    public function delete(Customer $customer): bool
    {
        return $this->repository->delete($customer);
    }
}
