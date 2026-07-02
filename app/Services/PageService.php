<?php

namespace App\Services;

use App\Models\Page;
use App\Repositories\Contracts\PageRepositoryInterface;
use App\Traits\GeneratesUniqueSlug;
use Illuminate\Database\Eloquent\Collection;

class PageService
{
    use GeneratesUniqueSlug;

    public function __construct(protected PageRepositoryInterface $repository)
    {
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data): Page
    {
        $data['slug'] = $this->uniqueSlug(Page::class, $data['title']);

        /** @var Page $page */
        $page = $this->repository->create($data);

        return $page;
    }

    public function update(Page $page, array $data): Page
    {
        if ($data['title'] !== $page->title) {
            $data['slug'] = $this->uniqueSlug(Page::class, $data['title'], $page->id);
        }

        /** @var Page $updated */
        $updated = $this->repository->update($page, $data);

        return $updated;
    }

    public function delete(Page $page): bool
    {
        return $this->repository->delete($page);
    }
}
