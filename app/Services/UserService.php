<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(protected UserRepositoryInterface $repository)
    {
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data, array $roles): User
    {
        $data['password'] = Hash::make($data['password']);

        /** @var User $user */
        $user = $this->repository->create($data);

        $user->syncRoles($roles);

        return $user;
    }

    public function update(User $user, array $data, array $roles): User
    {
        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        /** @var User $updated */
        $updated = $this->repository->update($user, $data);

        $updated->syncRoles($roles);

        return $updated;
    }

    public function delete(User $user): bool
    {
        return $this->repository->delete($user);
    }
}
