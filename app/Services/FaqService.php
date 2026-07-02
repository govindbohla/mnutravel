<?php

namespace App\Services;

use App\Models\Faq;
use App\Repositories\Contracts\FaqRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class FaqService
{
    public function __construct(protected FaqRepositoryInterface $repository)
    {
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data): Faq
    {
        /** @var Faq $faq */
        $faq = $this->repository->create($data);

        return $faq;
    }

    public function update(Faq $faq, array $data): Faq
    {
        /** @var Faq $updated */
        $updated = $this->repository->update($faq, $data);

        return $updated;
    }

    public function delete(Faq $faq): bool
    {
        return $this->repository->delete($faq);
    }
}
