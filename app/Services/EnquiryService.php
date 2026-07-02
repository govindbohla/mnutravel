<?php

namespace App\Services;

use App\Models\Enquiry;
use App\Repositories\Contracts\EnquiryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EnquiryService
{
    public function __construct(protected EnquiryRepositoryInterface $repository)
    {
    }

    public function paginate(array $filters, int $perPage = 20): LengthAwarePaginator
    {
        return $this->repository->paginateFiltered($filters, $perPage);
    }

    public function create(array $data): Enquiry
    {
        /** @var Enquiry $enquiry */
        $enquiry = $this->repository->create($data);

        return $enquiry;
    }

    public function update(Enquiry $enquiry, array $data): Enquiry
    {
        /** @var Enquiry $updated */
        $updated = $this->repository->update($enquiry, $data);

        return $updated;
    }

    public function delete(Enquiry $enquiry): bool
    {
        return $this->repository->delete($enquiry);
    }
}
