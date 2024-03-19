<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    /**
     * UserRepository constructor.
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Return all the user
     */
    public function getAllUsers(?array $relationNames = []): LengthAwarePaginator
    {
        return $this->model
            ->when(! empty($relationNames), function ($query) use ($relationNames) {
                return $query->with($relationNames);
            })
            ->oldest('name')
            ->paginate(10);
    }

    /**
     * Create new user and return the user object
     */
    public function createUser(array $userDetails): User
    {
        return $this->model->create($userDetails);
    }

    /**
     * Find user by ID and return the user object
     */
    public function getUserById(string $userID, ?array $relationNames = [], ?string $withTrashed = null): User
    {
        return $this->model->when(! empty($relationNames), function ($query) use ($relationNames) {
            return $query->with($relationNames);
        })->when(($withTrashed == 'withTrashed'), function ($query) {
            return $query->withTrashed();
        })->where('id', $userID)->latest()->first();
    }

    /**
     * Update user
     */
    public function updateUser(object $user, array $newDetails): bool
    {
        return $user->update($newDetails);
    }

    /**
     * Temporary delete a user
     */
    public function deleteUser(object $user): bool
    {
        return $user->delete();
    }

    /**
     * Restore a user
     */
    public function restore(object $user): bool
    {
        return $user->restore();
    }

    /**
     * Force delete a user
     */
    public function forceDelete(object $user): bool
    {
        return $user->forceDelete();
    }

    /**
     * Restore all deleted users
     */
    public function restoreAll(): bool
    {
        return $this->model->onlyTrashed()->restore();
    }

    /**
     * Return all deleted users
     */
    public function trash(): LengthAwarePaginator
    {
        return $this->model->onlyTrashed()->paginate(10);
    }
}
